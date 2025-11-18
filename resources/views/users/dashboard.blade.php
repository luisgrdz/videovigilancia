@extends('components.layouts.app')

@section('titulo','Mi Panel')

@section('contenido')
<div class="max-w-5xl mx-auto">
    
    {{-- Banner de Bienvenida --}}
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl shadow-lg p-8 text-white mb-8">
        <h1 class="text-3xl font-bold mb-2">Hola, {{ auth()->user()->name }} 👋</h1>
        <p class="text-blue-100 opacity-90">Bienvenido a tu panel de gestión personal. Aquí puedes administrar tus cámaras asignadas.</p>
    </div>

    {{-- Sección de Accesos Directos --}}
    <h2 class="text-xl font-bold text-gray-800 mb-4">¿Qué deseas hacer hoy?</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Tarjeta: Mis Cámaras -->
        <a href="{{ route('user.cameras.index') }}" class="block group">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:border-blue-200 transition duration-200 h-full flex items-start">
                <div class="p-4 bg-blue-50 rounded-lg text-blue-600 mr-5 group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-blue-700">Mis Cámaras</h3>
                    <p class="text-gray-500 text-sm">Consulta el listado de tus dispositivos, revisa su estatus o edita su información.</p>
                    <span class="mt-4 inline-block text-sm font-medium text-blue-600 group-hover:underline">Ir al listado &rarr;</span>
                </div>
            </div>
        </a>

        <!-- Tarjeta: Agregar Cámara -->
        <a href="{{ route('user.cameras.create') }}" class="block group">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:border-green-200 transition duration-200 h-full flex items-start">
                <div class="p-4 bg-green-50 rounded-lg text-green-600 mr-5 group-hover:bg-green-600 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-green-700">Registrar Cámara</h3>
                    <p class="text-gray-500 text-sm">Añade un nuevo dispositivo al sistema. Necesitarás la IP y la ubicación.</p>
                    <span class="mt-4 inline-block text-sm font-medium text-green-600 group-hover:underline">Agregar nueva &rarr;</span>
                </div>
            </div>
        </a>

    </div>
</div>
@endsection