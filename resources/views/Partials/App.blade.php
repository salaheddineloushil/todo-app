<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="To-Do App - Organize your tasks, manage projects and boost productivity.">
    <meta name="keywords" content="todo app, task manager, project management, productivity app, daily planner, work organizer">
    <meta name="salah eddine loushil" content="TODO-APP">

    <title>@yield('title', 'TODO APP')</title>

    <link rel="icon" href="https://todo-app-kemwg.sevalla.app/images/icon.png" type="image/png">
    <link rel="stylesheet" href="https://todo-app-kemwg.sevalla.app/bootstrap.min.css">
    <link rel="stylesheet" href="https://todo-app-kemwg.sevalla.app/fontawesome-free-7.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://todo-app-kemwg.sevalla.app/css/app.css">
    <script src="https://todo-app-kemwg.sevalla.app/bootstrap.bundle.min.js"></script>
    @yield('page-css')
</head>


<body>
    @include('Partials.Navbar')

    @if (!request()->routeIs('login') && !request()->routeIs('signup'))
        <div class="container" style="padding-top: 30px;">
            @yield('content')
        </div>
    @endif
    @yield('login')
    @yield('signup')

    @include('Partials.Footer')
</body>

</html>
