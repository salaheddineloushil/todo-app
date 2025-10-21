@extends('Partials.App')
@section('title', 'My Tasks')
@section('content')
    <div class="container my-4">
        <h1 class="mb-4">My Tasks</h1>
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>User</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                            <td>{{ $task->created_at ? $task->created_at->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $task->user?->name ?? 'N/A' }}</td>
                            <td>{{ $task->category?->name ?? 'N/A' }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
