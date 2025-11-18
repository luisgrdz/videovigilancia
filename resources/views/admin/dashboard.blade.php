@extends('components.layouts.app')

@section('titulo','Dashboard Admin')

@section('contenido')
<div class="max-w-7xl mx-auto">
    
    {{-- Encabezado con saludo y fecha --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Panel de Control</h1>
            <p class="text-gray-500 mt-1">Resumen general del sistema de videovigilancia.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                <span class="w-2 h-2 mr-2 bg-blue-600 rounded-full"></span>
                Admin
            </span>
        </div>
    </div>

    <!-- SECCIÓN 1: ESTADÍSTICAS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        
        <!-- Tarjeta: Usuarios -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Personal Registrado</p>
                <p class="text-3xl font-black text-gray-800 mt-1">{{ $totalUsers }}</p>
            </div>
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Tarjeta: Total Cámaras -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Dispositivos</p>
                <p class="text-3xl font-black text-gray-800 mt-1">{{ $totalCameras }}</p>
            </div>
            <div class="p-3 bg-indigo-50 rounded-full text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <!-- Tarjeta: Cámaras Activas -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 flex items-center justify-between transition hover:shadow-md">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Cámaras Online</p>
                <p class="text-3xl font-black text-gray-800 mt-1">{{ $activeCameras }}</p>
            </div>
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 2: ACCIONES RÁPIDAS -->
    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
        </svg>
        Acciones Rápidas
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Gestión Personal -->
        <a href="{{ route('admin.personal.index') }}" class="group bg-white p-4 rounded-lg border border-gray-200 hover:border-blue-400 hover:shadow-md transition duration-200 flex flex-col items-center justify-center text-center h-32">
            <div class="bg-blue-50 p-2 rounded-full text-blue-600 mb-2 group-hover:bg-blue-600 group-hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <span class="font-semibold text-gray-700 group-hover:text-blue-700">Ver Personal</span>
        </a>

        <a href="{{ route('admin.personal.create') }}" class="group bg-white p-4 rounded-lg border border-gray-200 hover:border-blue-400 hover:shadow-md transition duration-200 flex flex-col items-center justify-center text-center h-32">
            <div class="bg-blue-50 p-2 rounded-full text-blue-600 mb-2 group-hover:bg-blue-600 group-hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <span class="font-semibold text-gray-700 group-hover:text-blue-700">Nuevo Personal</span>
        </a>

        <!-- Gestión Cámaras -->
        <a href="{{ route('admin.cameras.index') }}" class="group bg-white p-4 rounded-lg border border-gray-200 hover:border-indigo-400 hover:shadow-md transition duration-200 flex flex-col items-center justify-center text-center h-32">
            <div class="bg-indigo-50 p-2 rounded-full text-indigo-600 mb-2 group-hover:bg-indigo-600 group-hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="font-semibold text-gray-700 group-hover:text-indigo-700">Ver Cámaras</span>
        </a>

        <a href="{{ route('admin.cameras.create') }}" class="group bg-white p-4 rounded-lg border border-gray-200 hover:border-indigo-400 hover:shadow-md transition duration-200 flex flex-col items-center justify-center text-center h-32">
            <div class="bg-indigo-50 p-2 rounded-full text-indigo-600 mb-2 group-hover:bg-indigo-600 group-hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <span class="font-semibold text-gray-700 group-hover:text-indigo-700">Nueva Cámara</span>
        </a>
    </div>
</div>
@endsection