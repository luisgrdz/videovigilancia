@extends('components.layouts.app')

@section('titulo', 'Panel de Cámaras')

@section('contenido')

@php
    $prefix = Request::is('admin*') ? 'admin.' : (Request::is('supervisor*') ? 'supervisor.' : (Request::is('mantenimiento*') ? 'mantenimiento.' : 'user.'));
@endphp

<div class="flex flex-col sm:flex-row justify-between items-end mb-10 gap-4">
    <div>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight">Mis Cámaras</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2 text-lg">Panel de monitoreo en tiempo real.</p>
    </div>
    <a href="{{ route($prefix . 'cameras.create') }}" class="group inline-flex items-center justify-center px-6 py-3 text-base font-bold text-white transition-all duration-200 bg-indigo-600 rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-lg shadow-indigo-500/30">
        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
        Agregar Cámara
    </a>
</div>

@if($cameras->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($cameras as $camera)
            <div class="group bg-white dark:bg-gray-800 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden relative hover:-translate-y-2">
                
                <div class="h-48 bg-gray-50 dark:bg-gray-900 relative flex items-center justify-center overflow-hidden">
                    @if($camera->status)
                        <div class="absolute inset-0 bg-green-500/10 flex items-center justify-center">
                            <div class="relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-20"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                            </div>
                        </div>
                        <span class="absolute top-4 right-4 px-3 py-1 bg-green-100 dark:bg-green-900/60 text-green-700 dark:text-green-300 text-xs font-bold rounded-lg border border-green-200 dark:border-green-800 backdrop-blur-sm">
                            EN LÍNEA
                        </span>
                    @else
                        <div class="flex flex-col items-center text-gray-300 dark:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                            <span class="font-bold text-sm tracking-widest">OFFLINE</span>
                        </div>
                    @endif

                    <a href="{{ route($prefix . 'cameras.show', $camera) }}" class="absolute inset-0 bg-black/40 dark:bg-black/60 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer">
                        <span class="bg-white text-gray-900 px-6 py-3 rounded-full font-bold shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                            Ver Transmisión
                        </span>
                    </a>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1 truncate">{{ $camera->name }}</h3>
                    <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        {{ $camera->location ?? 'Ubicación no asignada' }}
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route($prefix . 'cameras.edit', $camera) }}" class="block w-full text-center py-2.5 px-4 bg-gray-50 dark:bg-gray-700/50 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-xl text-sm font-semibold transition-colors">
                            Configuración Técnica
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $cameras->links() }}
    </div>
@else
    <div class="flex flex-col items-center justify-center py-20 bg-white dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700">
        <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-full mb-4">
            <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Sin dispositivos</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-6">Comienza agregando tu primera cámara.</p>
        <a href="{{ route($prefix . 'cameras.create') }}" class="text-indigo-600 font-bold hover:underline">Registrar ahora &rarr;</a>
    </div>
@endif

@endsection