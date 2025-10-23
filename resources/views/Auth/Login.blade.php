@extends('Partials.App')
@section('title', 'Login')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-7.1.0-web/css/all.min.css') }}">
@endsection

@section('login')
    <div class="login-page">
        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @if (session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="error-box">
                {{ session('error') }}
            </div>
        @endif
        <div class="ring p-4 ">
            <span style="--clr:#00ff0a;"></span>
            <span style="--clr:#ff0057;"></span>
            <span style="--clr:#fffd44;"></span>

            <div class="login">
                <h2>Login</h2>
                <form method="POST" action="{{ route('LoginStore') }}">
                    @csrf

                    <div class="inputBx my-1">
                        <input type="text" name="email" placeholder="Email" value="{{old('email')}}" required>
                    </div>

                    <div class="inputBx my-1">
                        <input type="password" id="password" name="password" placeholder="Password" value="{{old('password')}}" required>
                        <i class="fa-solid fa-eye toggle-password"
                            onclick="const pwd = document.getElementById('password');
                                     pwd.type = pwd.type === 'password' ? 'text' : 'password';
                                     this.classList.toggle('fa-eye');
                                     this.classList.toggle('fa-eye-slash');"></i>
                    </div>

                    <div class="inputBx my-2">
                        <input type="submit" value="Login" class="btn btn-primary btn-lg">
                    </div>

                    <div class="links p-3">
                        <a href="/forgotPassword">Forget Password?</a>
                        <a href="/signup">Signup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
