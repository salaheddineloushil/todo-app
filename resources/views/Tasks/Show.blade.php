@extends('Partials.App')
@section('title', 'Task Details')
@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Task Details</h1>
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $task->name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $task->description }}</p>
                <p class="card-text"><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $task->status)) }}</p>
                <p class="card-text"><strong>Created At:</strong>
                    {{ $task->created_at ? $task->created_at->format('Y-m-d') : 'N/A' }}</p>
                <p class="card-text"><strong>User:</strong> {{ $task->user->name }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $task->category->name }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning ms-2">Edit Task</a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-2" onclick="return confirm('Are you sure?')">
                        Delete Task
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
