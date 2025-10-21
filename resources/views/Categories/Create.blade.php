@extends('Partials.App')
@section('title', 'Create Category')
@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Create Category</h1>
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Create Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
@endsection
