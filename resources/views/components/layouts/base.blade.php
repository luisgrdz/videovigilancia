<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Monitoreo Inteligente')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f4f6f8;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Sidebar ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 240px;
            background-color: #1f1f2e;
            color: white;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .sidebar:hover {
            width: 260px;
        }

        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 1rem;
            text-align: center;
            background-color: #2a2a40;
            letter-spacing: 0.5px;
        }

        .sidebar a {
            display: block;
            color: #ddd;
            padding: 0.8rem 1rem;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #383850;
            color: #fff;
        }

        /* ===== Contenido principal ===== */
        main {
            margin-left: 240px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .navbar-custom {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-custom h5 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        .logout-btn {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">Monitoreo Inteligente</div>
        <a href="{{ route('admin.dashboard') }}">📊 Panel Principal</a>
        <a href="{{ route('cameras.index') }}">📹 Cámaras</a>
        <a href="{{ route('users.add') }}">👤 Personal</a>
        <a href="{{ route('register') }}">➕ Nuevo Usuario</a>
    </div>

    <!-- Navbar superior -->
    <div class="navbar-custom">
        <h5>@yield('titulo', 'Panel')</h5>
        @auth
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button class="logout-btn">Salir</button>
        </form>
        @endauth
    </div>

    <!-- Contenido -->
    <main>
        @yield('contenido')
    </main>

</body>
</html>
