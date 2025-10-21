@extends('Partials.App')
@section('title', 'Edit Task')
@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Edit Task</h1>
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Title:</label>
                <input type="text" id="name" name="name" value="{{ $task->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="4" required>{{ $task->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category:</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User:</label>
                <select id="user_id" name="user_id" class="form-select" required>
                    @foreach ($users as $user)
                        @if ($user->role === 'manager')
                            @continue
                        @elseif ($user->role === 'admin' && auth()->user()->role === 'manager' || auth()->user()->role === 'manager' && $user->role === 'user')
                            <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} <span>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </option>
                        @elseif ($user->role === 'user' && auth()->user()->role === 'admin')
                            <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} <span>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
@endsection
