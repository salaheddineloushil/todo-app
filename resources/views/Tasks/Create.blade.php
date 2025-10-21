@extends('Partials.App')
@section('title', 'Create Task')
@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Create Task</h1>
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category:</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label"></label>
                <select name="user_id" id="user_id" class="form-select" required>


                    @foreach ($users as $user)
                        @if ($user->role !== 'manager' && Auth::user()->role !== $user->role)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach

                </select>
            </div>

            <button type="submit" class="btn btn-success">Create Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
@endsection
