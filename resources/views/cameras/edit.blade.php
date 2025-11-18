@extends('components.layouts.app')

@section('titulo','Editar cámara')

@section('contenido')
<div class="max-w-md mx-auto mt-10">
    
    @php
        $prefix = Request::is('admin*') ? 'admin.' : 'user.';
    @endphp

    <div class="mb-4">
        <a href="{{ route($prefix . 'cameras.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Cancelar y volver</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Editar Cámara: {{ $camera->name }}</h1>

        {{-- FORMULARIO DE ACTUALIZACIÓN --}}
        <form method="POST" action="{{ route($prefix . 'cameras.update', $camera) }}">
            @csrf
            @method('PATCH') {{-- Importante para update --}}

            <!-- Nombre -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                <input type="text" class="input @error('name') border-red-500 @enderror" name="name" value="{{ old('name', $camera->name) }}" required>
                @error('name') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- IP -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">IP</label>
                <input type="text" class="input @error('ip') border-red-500 @enderror" name="ip" value="{{ old('ip', $camera->ip) }}" required>
                @error('ip') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Ubicación -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Ubicación</label>
                <input type="text" class="input @error('location') border-red-500 @enderror" name="location" value="{{ old('location', $camera->location) }}">
                @error('location') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Estatus -->
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Estatus</label>
                <select name="status" class="input bg-white">
                    {{-- Comprobamos si es 1 o 0 --}}
                    <option value="1" {{ old('status', $camera->status) == 1 ? 'selected' : '' }}>Activa</option>
                    <option value="0" {{ old('status', $camera->status) == 0 ? 'selected' : '' }}>Inactiva</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                Actualizar Cámara
            </button>
        </form>
    </div>
</div>
@endsection