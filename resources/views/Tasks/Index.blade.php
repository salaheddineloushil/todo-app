@extends('Partials.App')
@section('title', 'Tasks')
@section('content')
    <div class="container my-4">
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Tasks</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                        <td>{{ $task->user?->name ?? 'N/A' }}</td>
                        <td><span
                                class="badge 
                                @if ($task->user?->role == 'admin') bg-danger 
                                @elseif ($task->user?->role == 'manager') bg-success 
                                @else bg-primary @endif">{{ ucfirst($task->user?->role ?? 'N/A') }}</span>
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                               ²     onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
