@extends('components.layouts.app')

@section('titulo', 'Detalles de cámara')

@section('contenido')
<div class="max-w-2xl mx-auto mt-10">
    
    @php
        $prefix = Request::is('admin*') ? 'admin.' : 'user.';
    @endphp

    <div class="mb-4 flex justify-between">
        <a href="{{ route($prefix . 'cameras.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Volver al listado</a>
        <a href="{{ route($prefix . 'cameras.edit', $camera) }}" class="text-yellow-600 hover:underline text-sm font-bold">Editar esta cámara</a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">{{ $camera->name }}</h2>
            <span class="px-3 py-1 text-sm rounded-full {{ $camera->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $camera->status ? 'Activa' : 'Inactiva' }}
            </span>
        </div>
        
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- IP -->
                <div class="bg-gray-50 p-3 rounded">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Dirección IP</label>
                    <p class="mt-1 text-lg font-mono text-gray-900">{{ $camera->ip }}</p>
                </div>

                <!-- Ubicación -->
                <div class="bg-gray-50 p-3 rounded">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Ubicación</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $camera->location ?? 'No especificada' }}</p>
                </div>
            </div>

            <!-- Fechas -->
            <div class="text-xs text-gray-400 border-t pt-4 mt-4">
                <p>Registrada el: {{ $camera->created_at->format('d/m/Y H:i') }}</p>
                <p>Última actualización: {{ $camera->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection