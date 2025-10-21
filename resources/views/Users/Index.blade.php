@extends('Partials.App')
@section('title', 'Users')
@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Users</h1>
        @if (session('error'))
            <div class="alert alert-danger text-center mt-2">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>There Tasks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span
                                class="badge 
                                @if ($user->role == 'admin') bg-danger 
                                @elseif ($user->role == 'manager') bg-success 
                                @else bg-primary @endif">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td><a class="btn btn-warning" href="{{ route('myTasks', $user->id) }}">Tasks</a></td>

                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-success">Show</a>

                            @if (Auth::user()->role !== $user->role)
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
