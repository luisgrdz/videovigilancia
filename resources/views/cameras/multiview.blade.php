@extends('components.layouts.app')

@section('titulo', 'Video Wall - Monitoreo')

@section('contenido')

    @php
        // Detectamos el prefijo para los enlaces
        $role = Auth::user()->role->name ?? 'user';
        $prefix = match ($role) {
            'admin' => 'admin.',
            'supervisor' => 'supervisor.',
            'mantenimiento' => 'mantenimiento.',
            default => 'user.',
        };
    @endphp

    <div class="flex justify-between items-center mb-6 animate-fade-in-down">
        <div>
             <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Video Wall en Vivo
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Mostrando {{ $cameras->count() }} dispositivos activos.</p>
        </div>
        <a href="{{ route($prefix . 'cameras.index') }}" class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
            Vista de Lista
        </a>
    </div>

    @if($cameras->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 auto-rows-fr">
            @foreach($cameras as $camera)
                @php
                    // Usamos el nuevo Helper para obtener los datos del video
                    $videoData = \App\Helpers\VideoHelper::parseUrl($camera->ip);
                @endphp

                <div class="relative bg-black rounded-xl overflow-hidden shadow-lg border border-slate-800 group aspect-video">
                    
                    @if($videoData['isYoutube'])
                        <iframe src="{{ $videoData['streamUrl'] }}" class="w-full h-full pointer-events-none" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    @else
                        <img src="{{ $videoData['streamUrl'] }}" class="w-full h-full object-cover" alt="{{ $camera->name }}"
                             onerror="this.onerror=null; this.parentElement.querySelector('.error-overlay').classList.remove('hidden');">
                        
                        <div class="error-overlay hidden absolute inset-0 bg-slate-900/80 flex flex-col items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                            <span class="text-xs font-bold">Sin señal</span>
                        </div>
                    @endif

                    <div class="absolute top-0 left-0 w-full p-3 bg-gradient-to-b from-black/70 to-transparent flex justify-between items-start">
                        <h3 class="text-white font-bold text-sm truncate drop-shadow-md">{{ $camera->name }}</h3>
                        <span class="flex h-2 w-2 relative mt-1">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                        </span>
                    </div>
                    
                    <div class="absolute bottom-0 left-0 w-full p-2 bg-gradient-to-t from-black/80 to-transparent flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-slate-300 text-xs truncate">{{ $camera->location }}</span>
                        <a href="{{ route($prefix . 'cameras.show', $camera) }}" class="p-1.5 bg-blue-600/80 hover:bg-blue-600 text-white rounded-lg backdrop-blur-sm transition-colors" title="Ver en grande">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-32 text-center">
            <div class="p-4 bg-slate-100 dark:bg-slate-800 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-700 dark:text-slate-200">No hay transmisiones activas</h3>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Activa cámaras en el inventario para verlas aquí.</p>
        </div>
    @endif

@endsection