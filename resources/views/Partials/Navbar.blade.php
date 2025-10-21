<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Logo / Brand -->
        <a class="navbar-brand" href="/">TODO APP</a>

        <!-- Toggler (for small screens) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="fa fa-home"></i> Dashboard</a>
                </li>

                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.show', auth()->id()) }}"><i
                                class="fa fa-circle-user"></i> Details</a></li>
                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                        <li class="nav-item">
                            <a class="nav-link" href="/users"><i class="fa fa-users"></i> Users</a>
                        </li>
                    @endif

                    @if (Auth::user()->role === 'manager' || Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="/tasks"><i class="fa fa-tasks"></i> Tasks</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/myTasks/{{ auth()->id() }}"><i class="fa fa-bars"></i> My Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories"><i class="fa fa-list"></i> Categories</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fa fa-user"></i> Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/signup"><i class="fa fa-user-plus"></i> Sign up</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
