{{--
@php
    $adminMenus = app(\App\Services\MenuService::class)
        ->getForUser(auth()->user());
@endphp
--}}

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6f8;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #1f2933;
            color: #fff;
            padding: 20px;
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .sidebar h4 {
            margin: 20px 0 10px;
            font-size: 12px;
            opacity: 0.6;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            padding: 8px 0;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar a:hover {
            opacity: 0.8;
        }

        .sidebar form {
            margin-top: 30px;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="app">
    <div class="sidebar">
        <h2>Admin Panel</h2>

        <h4>Admin</h4>
        <a href="{{ route('admin.users.index') }}">Users</a>
        <a href="{{ route('admin.roles.index') }}">Roles</a>

        <h4>Menu</h4>
        <a href="{{ route('admin.menus.index') }}">Menus
        </a>

        <ul>
            @foreach($adminMenus as $menu)
                <li>
                    <a href="{{ route('admin.page', $menu->slug) }}">
                        {{ $menu->title }}
                    </a>
                </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>

    </div>

    <div class="content">
        <div class="card">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
