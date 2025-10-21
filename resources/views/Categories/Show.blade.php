@extends('Partials.App')
@section('title', 'Category Details')
@section('content')
    <div class="container my-5">
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Category Details</h4>
                <span class="badge bg-light text-dark">{{ $category->created_at?->format('Y-m-d') ?? 'N/A' }}</span>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <strong>Name:</strong>
                    <p class="form-control-plaintext ps-2 border-start border-3 border-primary">{{ $category->name }}</p>
                </div>

                <div class="mb-3">
                    <strong>Description:</strong>
                    <p class="form-control-plaintext ps-2 border-start border-3 border-secondary">
                        {{ $category->description }}</p>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back to Categories
                </a>

                @if (auth()->user()->role === 'manager')
                    <div class="d-flex gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit me-1"></i> Edit
                        </a>

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fa fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
