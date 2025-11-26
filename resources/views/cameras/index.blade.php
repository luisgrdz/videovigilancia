@extends('components.layouts.app')

@section('titulo', 'Panel de Control')

@section('contenido')

@php
    // Detectamos rol para prefijos (útil para rutas que dependen del prefijo)
    $prefix = Request::is('admin*') ? 'admin.' : (Request::is('supervisor*') ? 'supervisor.' : (Request::is('mantenimiento*') ? 'mantenimiento.' : 'user.'));
@endphp

<div class="flex flex-col sm:flex-row justify-between items-end mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Mis Dispositivos</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">Panel de monitoreo en tiempo real.</p>
    </div>
    
    <div class="flex gap-3">
        <a href="{{ route($prefix . 'cameras.multiview') }}" class="group inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 text-sm font-bold rounded-xl shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Video Wall
        </a>

        @can('crear_camaras')
        <a href="{{ route($prefix . 'cameras.create') }}" class="group inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/25 transition-all hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Nueva Cámara
        </a>
        @endcan
    </div>
</div>

@if($cameras->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($cameras as $camera)
            <div class="group relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl hover:shadow-slate-200/50 dark:hover:shadow-black/50 transition-all duration-300 border border-slate-200 dark:border-slate-700 overflow-hidden">
                
                <div class="h-40 bg-slate-100 dark:bg-slate-900 relative flex items-center justify-center overflow-hidden">
                    @if($camera->status)
                        <div class="absolute inset-0 bg-emerald-500/5 flex items-center justify-center">
                            <div class="relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-20"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-500 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 px-2.5 py-0.5 bg-white/90 dark:bg-slate-900/90 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold uppercase tracking-wide rounded-md shadow-sm border border-emerald-200 dark:border-emerald-900 backdrop-blur-sm">
                            ● En Vivo
                        </span>
                    @else
                        <div class="flex flex-col items-center text-slate-300 dark:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                            <span class="text-xs font-bold tracking-widest uppercase">Offline</span>
                        </div>
                    @endif

                    <a href="{{ route($prefix . 'cameras.show', $camera) }}" class="absolute inset-0 bg-slate-900/40 backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center cursor-pointer">
                        <div class="bg-white dark:bg-slate-800 text-slate-900 dark:text-white p-3 rounded-full shadow-xl transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </a>
                </div>

                <div class="p-5">
                    <div class="flex justify-between items-start gap-2 mb-2">
                        <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 truncate" title="{{ $camera->name }}">{{ $camera->name }}</h3>
                    </div>
                    
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <span class="truncate">{{ $camera->location ?? 'Sin ubicación' }}</span>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-700 grid {{ Auth::user()->can('editar_camaras') ? 'grid-cols-2' : 'grid-cols-1' }} gap-2">
                        
                        <a href="{{ route($prefix . 'cameras.show', $camera) }}" class="text-center py-2 px-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-semibold hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                            Ver
                        </a>

                        @can('editar_camaras')
                        <a href="{{ route($prefix . 'cameras.edit', $camera) }}" class="text-center py-2 px-3 rounded-lg bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
                            Ajustes
                        </a>
                        @endcan

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $cameras->links() }}
    </div>
@else
    <div class="flex flex-col items-center justify-center py-24 bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 text-center">
        <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-full mb-4">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Sin cámaras activas</h3>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 mb-6 max-w-xs">No hay dispositivos disponibles para visualizar.</p>
        
        @can('crear_camaras')
        <a href="{{ route($prefix . 'cameras.create') }}" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg shadow-md transition-all">
            Registrar Cámara
        </a>
        @endcan
    </div>
@endif

@endsection