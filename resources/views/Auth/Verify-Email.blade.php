{{-- @extends('Partials.App')

@section('title', 'Verify email')

@section('content')
<div class="container mt-5">
    <h2>Verify Your Email Address</h2>
    
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            A fresh verification link has been sent to your email address.
        </div>
    @endif

    <p>
        Before proceeding, please check your email for a verification link.
        If you did not receive the email,
    </p>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Click here to request another</button>
    </form>
</div>
@endsection --}}
