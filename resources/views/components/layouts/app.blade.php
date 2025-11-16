<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Videovigilancia')</title>

    @vite('resources/css/app.css')

    <!-- Fuente moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e7ecff, #f7f9ff, #ede8ff);
        }

        /* NAV estilo claro con borde suave */
        .nav-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid rgba(180, 190, 255, 0.25);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Links */
        .nav-link-custom {
            font-weight: 600;
            color: #444;
            transition: 0.25s;
        }

        .nav-link-custom:hover {
            color: #6a5af9; /* morado suave */
            transform: translateY(-1px);
        }

        /* Botón cerrar sesión */
        .btn-logout {
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            color: white;
            padding: 8px 16px;
            border-radius: 14px;
            font-weight: 600;
            transition: 0.25s;
        }

        .btn-logout:hover {
            transform: scale(1.04);
            box-shadow: 0px 5px 12px rgba(255, 120, 120, 0.4);
        }

        /* Contenedor principal */
        main {
            animation: fadeIn .6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="text-gray-800">

    <!-- NAV -->
    <nav class="nav-glass">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->
            <div class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                📹 Videovigilancia
            </div>

            @auth
            <div class="flex items-center gap-6">

                <!-- ENLACE DEL PANEL -->
                @if(auth()->user()->role->name === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-custom">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('users.dashboard') }}" class="nav-link-custom">
                        Mi Panel
                    </a>
                @endif

                <!-- BOTÓN CERRAR SESIÓN -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn-logout">
                        Cerrar sesión
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('contenido')
    </main>

</body>
</html>
