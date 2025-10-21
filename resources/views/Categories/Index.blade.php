@extends('Partials.App')
@section('title', 'Categories')
@section('content')
    <div class="container my-4">
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Categories</h1>
            @if (auth()->user()->role !== 'user')
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
            @endif
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                            @if (auth()->user()->role === 'manager' || auth()->user()->role === 'admin')
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
