# Use official PHP image
FROM php:8.2-fpm

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
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel cache
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port (important for Kinsta/Railway)
EXPOSE 8080

# Start Laravel app
CMD php artisan serve --host=0.0.0.0 --port=8080
