<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Videovigilancia')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Ocultar scrollbar para un look más app-like (opcional) */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .dark ::-webkit-scrollbar-thumb { background-color: #475569; }
    </style>

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-50 transition-colors duration-300 min-h-screen flex flex-col">

    <nav class="sticky top-0 z-50 w-full bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200 dark:border-slate-800 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 dark:bg-blue-500 text-white p-2 rounded-xl shadow-lg shadow-blue-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <a href="/" class="font-bold text-xl tracking-tight text-slate-800 dark:text-white hover:opacity-80 transition-opacity">
                        Vision<span class="text-blue-600 dark:text-blue-400">Guard</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center bg-slate-100/50 dark:bg-slate-800/50 p-1 rounded-full border border-slate-200 dark:border-slate-700">
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

                        @if(in_array($role, ['admin', 'supervisor']))
                            <a href="{{ route($role . '.dashboard') }}" 
                               class="{{ Request::routeIs($role . '.dashboard') ? 'bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200' }} px-4 py-1.5 rounded-full text-sm font-medium transition-all">
                                Inicio
                            </a>
                        @endif

                        <a href="{{ route($prefix . 'cameras.index') }}" 
                           class="{{ Request::routeIs('*cameras*') ? 'bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200' }} px-4 py-1.5 rounded-full text-sm font-medium transition-all">
                            Cámaras
                        </a>

                        @if($role === 'admin')
                            <a href="{{ route('admin.personal.index') }}" 
                               class="{{ Request::routeIs('admin.personal*') ? 'bg-white dark:bg-slate-700 text-blue-600 dark:text-blue-400 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200' }} px-4 py-1.5 rounded-full text-sm font-medium transition-all">
                                Personal
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center gap-4">
                    <button id="theme-toggle" type="button" class="p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors focus:outline-none">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>

                    @auth
                        <div class="h-6 w-px bg-slate-200 dark:bg-slate-700"></div>
                        
                        <div class="flex items-center gap-3">
                            <div class="text-right hidden sm:block">
                                <p class="text-xs font-bold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-blue-600 dark:text-blue-400 uppercase tracking-wider font-semibold">{{ Auth::user()->role->name ?? 'Usuario' }}</p>
                            </div>
                            
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="group bg-red-50 dark:bg-red-900/20 p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors" title="Cerrar sesión">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 dark:text-red-400 group-hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
        @if(session('success'))
            <div class="mb-8 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/50 text-emerald-800 dark:text-emerald-200 flex items-center gap-3 shadow-sm">
                <div class="bg-emerald-100 dark:bg-emerald-800 p-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                </div>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="border-t border-slate-200 dark:border-slate-800 mt-auto py-8 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm text-slate-500 dark:text-slate-400">&copy; {{ date('Y') }} Sistema de Videovigilancia Inteligente</p>
        </div>
    </footer>

    <script>
        // Lógica del tema oscuro
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        var themeToggleBtn = document.getElementById('theme-toggle');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

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