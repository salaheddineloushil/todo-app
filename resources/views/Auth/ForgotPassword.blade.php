@extends('Partials.App')
@section('title', 'Forget Password')
@section('login')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                    <h3 class="mb-0">🔒 Forget Password</h3>
                </div>
                <div class="card-body p-4">
                    @if (session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('forgotPassword') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary btn-lg">Send Password Reset Link</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-light py-3 rounded-bottom-4">
                    <a href="{{ route('login') }}" class="btn btn-md btn-warning text-decoration-none">← Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
