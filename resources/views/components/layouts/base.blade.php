<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('titulo', 'Monitoreo Inteligente')</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
<style>
body {
    background-color: #f4f6f8;
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
}

/* ===== Sidebar ===== */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 64px; /* Minimizado */
    background-color: #1f1f2e;
    color: white;
    transition: width 0.3s ease;
    overflow: hidden;
    z-index: 50;
    display: flex;
    flex-direction: column;
}
.sidebar:hover {
    width: 220px; /* Expandido */
}
.sidebar .brand {
    font-size: 1.4rem; /* un poco más grande */
    font-weight: bold;
    padding: 1.5rem 1rem;
    text-align: center;
    background-color: #2a2a40;
    white-space: nowrap;
    overflow: hidden;
}
.sidebar a {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: #ddd;
    padding: 1rem; /* un poco más grande */
    font-weight: 500;
    font-size: 1.05rem; /* ligeramente más grande */
    transition: all 0.3s ease;
    white-space: nowrap;
    overflow: hidden;
    position: relative;
}
.sidebar a span {
    opacity: 0;
    transition: opacity 0.3s ease;
}
.sidebar:hover a span {
    opacity: 1;
}
.sidebar a:hover {
    background-color: #383850;
    color: #fff;
}
.sidebar a.active {
    background-color: #4f46e5; /* Indigo-600 */
    color: white;
}

/* Tooltip para iconos */
.sidebar a .tooltip {
    position: absolute;
    left: 64px;
    background: #333;
    color: #fff;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    top: 50%;
    transform: translateY(-50%);
    z-index: 100;
    font-size: 0.85rem;
}
.sidebar a:hover .tooltip {
    opacity: 1;
}

/* ===== Contenido principal ===== */
main {
    margin-left: 64px;
    padding: 6rem 2rem 2rem 2rem;
    transition: margin-left 0.3s ease;
}
.sidebar:hover ~ main {
    margin-left: 220px;
}

/* ===== Navbar superior ===== */
.navbar-custom {
    position: fixed;
    top: 0;
    left: 64px;
    right: 0;
    height: 4rem;
    background-color: #fff;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
    transition: left 0.3s ease;
    z-index: 40;
}
.sidebar:hover ~ .navbar-custom {
    left: 220px;
}

.navbar-custom h5 {
    margin: 0;
    font-weight: 600;
    color: #333;
    font-size: 1.25rem;
}

.logout-btn {
    background-color: #e74c3c;
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.95rem;
    transition: background-color 0.3s ease, transform 0.2s ease;
}
.logout-btn:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
}

/* ===== Responsivo ===== */
@media (max-width: 768px) {
    .sidebar { width: 0; }
    .sidebar:hover { width: 200px; }
    main { margin-left: 0; padding-top: 6rem; }
    .sidebar:hover ~ main { margin-left: 200px; }
    .navbar-custom { left: 0; }
    .sidebar:hover ~ .navbar-custom { left: 200px; }
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar flex flex-col">
    <div class="brand">SV</div> <!-- Inicial visible -->
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        📊
        <span class="hidden md:inline">Panel Principal</span>
        
    </a>
    <a href="{{ route('cameras.index') }}" class="{{ request()->routeIs('cameras.*') ? 'active' : '' }}">
        📹
        <span class="hidden md:inline">Cámaras</span>
        
    </a>
    <a href="{{ route('admin.personal') }}" class="{{ request()->routeIs('admin.personal','users.*') ? 'active' : '' }}">
    👤
    <span class="hidden md:inline">Personal</span>
</a>

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
