<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Videovigilancia')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

   
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        
            background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 50%, #e0e7ff 100%);
            min-height: 100vh;
            color: #4b5563;
        }

       
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* Enlaces del Nav */
        .nav-link-custom {
            font-weight: 500;
            color: #6b7280;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link-custom:hover {
            color: #4f46e5; /* Indigo 600 */
            background: rgba(255, 255, 255, 0.6);
            transform: translateY(-1px);
        }

        /* Botón Logout con degradado */
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
            filter: brightness(1.05);
        }

       
        main {
            animation: fadeUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav class="nav-glass shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <!-- LOGO -->
                <div class="flex items-center gap-2">
                    <span class="text-3xl">📹</span>
                    <div class="flex flex-col">
                        <span class="font-bold text-xl bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent leading-tight">
                            Videovigilancia
                        </span>
                        <span class="text-[10px] text-gray-400 font-medium tracking-widest uppercase">Security System</span>
                    </div>
                </div>

                @auth
                <div class="flex items-center gap-4 sm:gap-6">
                    
                    <!-- Enlaces condicionales -->
                    @if(Request::is('admin*'))
                        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom hidden sm:block">Inico</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="nav-link-custom hidden sm:block">Inicio</a>
                    @endif

                    <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-600 hidden sm:block">
                            {{ Auth::user()->name }}
                        </span>
                        
                        <!-- BOTÓN CERRAR SESIÓN -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn-gradient text-sm">
                                Salir
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENIDO -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        
        @if(session('success'))
            <div class="mb-6 glass-panel border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-r relative" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @yield('contenido')
    </main>

</body>
</html>