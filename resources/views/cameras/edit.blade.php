@extends('components.layouts.app')

@section('titulo','Editar cámara')

@section('contenido')

<h1 class="text-xl font-bold mb-4">Editar cámara</h1>

<form method="POST" action="{{ route('cameras.update', $camera) }}" class="bg-white p-6 rounded shadow max-w-md">
    @csrf
    @method('PATCH')

    <label>Nombre</label>
    <input class="input" name="name" value="{{ $camera->name }}" required>

    <label class="mt-3">IP</label>
    <input class="input" name="ip" value="{{ $camera->ip }}" required>

    <label class="mt-3">Ubicación</label>
    <input class="input" name="location" value="{{ $camera->location }}">

    <label class="mt-3">Estatus</label>
    <select name="status" class="input">
        <option value="active" {{ $camera->status == 'active' ? 'selected' : '' }}>Activa</option>
        <option value="inactive" {{ $camera->status == 'inactive' ? 'selected' : '' }}>Inactiva</option>
    </select>

    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded w-full">
        Guardar
    </button>
</form>

@endsection
