@extends('Partials.App')
@section('title', 'Dashboard')
@section('content')
    @if (session('error'))
        <div class="alert alert-danger text-center mt-2">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success my-4">
            {{ session('success') }}
        </div>
    @endif
    @auth
        <div class="container my-4 bg-secondary bg-opacity-50 p-3 rounded shadow-sm">
            <div class="d-flex align-items-center gap-2">
                <p class="mb-0">
                    Hello, <strong>{{ Auth::user()->name }}</strong>!
                </p>
                <span
                    class="badge 
                @if (Auth::user()->role == 'admin') bg-danger 
                @elseif (Auth::user()->role == 'manager') bg-success 
                @else bg-primary @endif">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>
    @endauth

    <!-- Details -->
    <div class="row bg-primary text-white p-3 rounded shadow-sm gy-3 text-center">
        <div class="col-md-4 col-12 d-flex align-items-center justify-content-center">
            <i class="fa fa-users me-2 fs-3"></i>
            <div>
                <p class="mb-0">Users</p>
                <b>{{ $users }}</b>
            </div>
        </div>

        <div class="col-md-4 col-12 d-flex align-items-center justify-content-center">
            <i class="fa fa-layer-group me-2 fs-3"></i>
            <div>
                <p class="mb-0">Tasks</p>
                <b>{{ $tasks }}</b>
            </div>
        </div>

        <div class="col-md-4 col-12 d-flex align-items-center justify-content-center">
            <i class="fa fa-list-check me-2 fs-3"></i>
            <div>
                <p class="mb-0">Categories</p>
                <b>{{ $categories }}</b>
            </div>
        </div>
    </div>

    <!-- About -->
    <details class="mt-4 p-2">
        <summary class="fw-bold text-primary fst-italic bg-light p-2 rounded shadow-sm" style="cursor: pointer;">
            💠 About
        </summary>
        <div class="mt-2 ps-3 text-secondary">
            <p class="mt-2">
                This is a simple Todo application built with Laravel. It allows users to manage their tasks
                and categories efficiently.
            </p>
        </div>
    </details>

    <!-- Features -->
    <div class="row bg-info bg-opacity-75 p-4 mt-4 rounded shadow-sm text-white gy-3">
        <div class="col-md-4 col-12 text-center">
            <i class="fa fa-laptop h1 mb-2"></i>
            <h6 class="fw-bold">Fully Responsive</h6>
            <p>Built with a mobile-first approach, this layout looks stunning on any screen size — from phones to desktops!
            </p>
        </div>
        <div class="col-md-4 col-12 text-center">
            <i class="fa-brands fa-laravel h1 mb-2"></i>
            <h6 class="fw-bold">Laravel 11 Ready</h6>
            <p>Featuring the latest and most powerful build of the Laravel 11 framework — fast, secure, and
                developer-friendly!</p>
        </div>
        <div class="col-md-4 col-12 text-center">
            <i class="fa fa-terminal h1 mb-2"></i>
            <h6 class="fw-bold">Easy To Use</h6>
            <p>Easily add your own content, or customize the source files to make it uniquely yours!</p>
        </div>
    </div>

    <!-- Images -->
    <div class="my-4">
        <div class="row align-items-center gy-4">
            <div class="col-md-6 col-12">
                <img src="images/responsive.jpg" class="w-100 rounded shadow-sm" alt="Fully Responsive">
            </div>
            <div class="col-md-6 col-12 text-center text-md-start">
                <h2>Fully Responsive Experience</h2>
                <p>
                    Our theme is designed with a true mobile-first approach, ensuring that every element looks perfect
                    and functions flawlessly on any screen size. Whether your visitors are browsing from a smartphone,
                    tablet, laptop, or large desktop monitor, the layout automatically adapts to deliver an optimal
                    viewing experience. No need for extra configurations — everything just works seamlessly,
                    keeping your website fast, elegant, and user-friendly across all modern devices.
                </p>
            </div>
        </div>

        <div class="row align-items-center gy-4 mt-4">
            <div class="col-md-6 col-12 text-center text-md-start">
                <h2>Built with Laravel 11</h2>
                <p>
                    Fully updated and optimized for the latest version of Laravel, this theme takes advantage of
                    all the powerful new features and performance improvements the framework offers. With a clean structure,
                    modern routing system, and seamless integration with Blade components, your development process becomes
                    faster and more efficient.
                </p>
            </div>
            <div class="col-md-6 col-12">
                <img src="images/laravel.jpeg" class="w-100 rounded shadow-sm" alt="Updated For Laravel">
            </div>
        </div>

        <div class="row align-items-center gy-4 mt-4">
            <div class="col-md-6 col-12">
                <img src="images/easy.jpg" class="w-100 rounded shadow-sm" alt="Easy To Use">
            </div>
            <div class="col-md-6 col-12 text-center text-md-start">
                <h2>Simple to Use & Fully Customizable</h2>
                <p>
                    This template is crafted with clean and organized code, making it super easy to edit and adapt
                    to your own needs. Whether you’re a beginner or an experienced developer, you can quickly replace
                    the content, adjust the layout, and launch your project in minutes. No complex setup required —
                    just plug in your text and images, and you’re ready to go!
                </p>
            </div>
        </div>
    </div>

@endsection
