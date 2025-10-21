@extends('Partials.App')
@section('title', 'Details User')

@section('content')
    <div class="container my-5">
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">👤 User Details</h3>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Name:</strong>
                        <p class="form-control-plaintext">{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p class="form-control-plaintext">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Role:</strong>
                        <p>
                            <span
                                class="badge 
                                @if ($user->role == 'admin') bg-danger 
                                @elseif($user->role == 'manager') bg-success 
                                @else bg-primary @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>

                    <div class="col-md-6">
                        <strong>Created At:</strong>
                        <p class="form-control-plaintext">
                            {{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}
                        </p>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <p><strong>Tasks:</strong></p>
                    <a class="btn btn-warning" href="{{ route('myTasks', $user->id) }}">
                        <i class="fa fa-tasks"></i> View Tasks
                    </a>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Users
                </a>
            </div>
        </div>
    </div>
@endsection
