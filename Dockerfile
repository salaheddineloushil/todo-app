# Use official PHP image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Copy .env before caching config
COPY .env .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear and cache config/routes/views
RUN php artisan config:clear
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8080

# Start Laravel app
CMD php artisan serve --host=0.0.0.0 --port=8080
