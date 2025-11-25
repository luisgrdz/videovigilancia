@extends('components.layouts.app')

@section('titulo', 'Panel de Supervisor')

@section('contenido')

<div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Panel de Supervisión</h1>
        <p class="text-gray-500 mt-1">Resumen de actividad de tu grupo asignado.</p>
    </div>
    <div class="bg-purple-100 text-purple-700 px-4 py-1 rounded-full text-sm font-semibold border border-purple-200 flex items-center gap-2">
        <span class="w-2 h-2 bg-purple-600 rounded-full animate-pulse"></span>
        Supervisor de Zona
    </div>
</div>

<!-- STATS GRID -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    
    <!-- Tarjeta Total -->
    <div class="glass-panel rounded-2xl p-6 hover:shadow-lg transition-shadow duration-300 relative overflow-hidden">
        <div class="relative z-10">
            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Cámaras Asignadas</p>
            <div class="flex items-baseline gap-2 mt-1">
                <h2 class="text-4xl font-bold text-gray-800">{{ $totalCameras ?? 0 }}</h2>
                <span class="text-sm text-gray-400">dispositivos</span>
            </div>
        </div>
        <div class="absolute right-0 top-0 p-4 opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </div>
    </div>

    <!-- Tarjeta Online -->
    <div class="glass-panel rounded-2xl p-6 hover:shadow-lg transition-shadow duration-300 relative overflow-hidden">
        <div class="relative z-10">
            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Estado Operativo</p>
            <div class="flex items-baseline gap-2 mt-1">
                <h2 class="text-4xl font-bold text-gray-800">{{ $activeCameras ?? 0 }}</h2>
                <span class="text-sm font-medium text-green-600">En línea</span>
            </div>
        </div>
        <div class="absolute right-0 top-0 p-4 opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Tarjeta Personal -->
    <div class="glass-panel rounded-2xl p-6 hover:shadow-lg transition-shadow duration-300 relative overflow-hidden">
        <div class="relative z-10">
            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Personal a Cargo</p>
            <div class="flex items-baseline gap-2 mt-1">
                <h2 class="text-4xl font-bold text-gray-800">{{ Auth::user()->subordinates()->count() }}</h2>
                <span class="text-sm text-gray-400">usuarios</span>
            </div>
        </div>
        <div class="absolute right-0 top-0 p-4 opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>
</div>

<!-- Accesos Rápidos -->
<h3 class="text-xl font-bold text-gray-800 mb-4">Acciones Rápidas</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <a href="{{ route('supervisor.cameras.index') }}" class="glass-panel p-6 rounded-xl flex items-center gap-4 transition-transform hover:-translate-y-1 hover:shadow-md group">
        <div class="bg-purple-50 p-3 rounded-lg text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </div>
        <div>
            <span class="block font-bold text-gray-700 group-hover:text-purple-700 transition-colors">Ver Cámaras</span>
            <span class="text-xs text-gray-500">Monitoreo en tiempo real</span>
        </div>
    </a>
</div>

@endsection