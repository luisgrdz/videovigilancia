<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Videovigilancia')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
        
        /* Estilo personalizado para la barra de navegación */
        .nav-link {
            @apply px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 flex items-center gap-2;
        }
        .nav-link-active {
            @apply bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300;
        }
        .nav-link-inactive {
            @apply text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white;
        }
    </style>

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300 min-h-screen flex flex-col">

    <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center gap-3 shrink-0">
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="bg-indigo-600 text-white p-2 rounded-xl shadow-lg shadow-indigo-500/40 group-hover:scale-105 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-bold text-2xl tracking-tight">Security<span class="text-indigo-600 dark:text-indigo-400">Pro</span></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-2">
                    @auth
                        @php
                            $role = Auth::user()->role->name ?? 'user';
                            $prefix = match ($role) {
                                'admin' => 'admin.',
                                'supervisor' => 'supervisor.',
                                'mantenimiento' => 'mantenimiento.',
                                default => 'user.',
                            };
                        @endphp

                        @if($role === 'admin' || $role === 'supervisor')
                            <a href="{{ route($role . '.dashboard') }}" class="nav-link {{ Request::routeIs($role . '.dashboard') ? 'nav-link-active' : 'nav-link-inactive' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                Inicio
                            </a>
                        @endif

                        <a href="{{ route($prefix . 'cameras.index') }}" class="nav-link {{ Request::routeIs('*cameras*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            Cámaras
                        </a>

                        @if($role === 'admin')
                            {{-- ELIMINADO EL BOTÓN DE USUARIOS QUE DABA ERROR --}}
                            
                            <a href="{{ route('admin.personal.index') }}" class="nav-link {{ Request::routeIs('admin.personal*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.56 1.613-1.355 1.92C7.47 8.22 6 9.5 6 11v.01M4 16h16" /></svg>
                                Personal
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center gap-3">
                    <button id="theme-toggle" type="button" class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none rounded-full text-sm p-2.5 transition-all">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>

                    @auth
                    <div class="h-8 w-px bg-gray-200 dark:bg-gray-700 mx-1"></div>
                    
                    <div class="flex items-center gap-3">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-bold dark:text-white leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase mt-0.5">{{ Auth::user()->role->name ?? 'Usuario' }}</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 text-red-600 dark:text-red-400 p-2 rounded-full transition-colors" title="Cerrar Sesión">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">
        @if(session('success'))
            <div class="mb-8 p-4 rounded-2xl bg-green-100 border border-green-200 text-green-800 dark:bg-green-900/30 dark:border-green-800 dark:text-green-200 flex items-center gap-3 shadow-sm animate-bounce-short">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="border-t border-gray-200 dark:border-gray-800 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
        &copy; {{ date('Y') }} Videovigilancia Pro
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>