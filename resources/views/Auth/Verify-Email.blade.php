@extends('Partials.App')
@section('title', 'Verify Your Email Address')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Verify Your Email Address</h4>
                    </div>

                    <div class="card-body text-center py-4">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <p class="mb-2">
                            Before proceeding, please check your email for a verification link.
                        </p>
                        <p class="mb-4">
                            If you did not receive the email, you can request another one below:
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">
                                Resend Verification Email
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
