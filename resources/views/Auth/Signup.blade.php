@extends('Partials.App')
@section('title', 'Sign Up')
@section('page-css')
    <link rel="stylesheet" href="https://todo-app-kemwg.sevalla.app/css/login.css">
    <link rel="stylesheet" href="https://todo-app-kemwg.sevalla.app/fontawesome-free-7.1.0-web/css/all.min.css">
@endsection

@section('signup')
    <div class="login-page">
        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="ring p-4 ">
            <span style="--clr:#00ff0a;"></span>
            <span style="--clr:#ff0057;"></span>
            <span style="--clr:#fffd44;"></span>
            <div class="login">
                <h2>Sign Up</h2>
                <form method="POST" action="{{ route('SignUpStore') }}">
                    @csrf
                    <div class="inputBx my-1">
                        <input type="text" id="name" name="name" placeholder="Username" value="{{old('name')}}" required>
                    </div>
                    <div class="inputBx my-1">
                        <input type="email" id="email" name="email" placeholder="Email" value="{{old('email')}}" required>
                    </div>
                    <div class="inputBx my-1">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="inputBx my-1">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="inputBx my-2">
                        <input type="submit" value="Sign Up" class="btn btn-primary btn-lg">
                    </div>

                    <div class="links p-3 text-white">
                        <b>Do u have an account?</b>
                        <a href="/login">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
