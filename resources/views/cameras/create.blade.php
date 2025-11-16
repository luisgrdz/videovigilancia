@extends('components.layouts.app')

@section('titulo','Registrar cámara')

@section('contenido')
<h1 class="text-xl font-bold mb-4">Registrar cámara</h1>

<form method="POST" action="{{ route('cameras.store') }}" class="bg-white p-6 rounded shadow max-w-md">
    @csrf

    <label>Nombre</label>
    <input class="input" name="name" required>

    <label class="mt-3">IP</label>
    <input class="input" name="ip" required>

    <label class="mt-3">Ubicación</label>
    <input class="input" name="location">

    <label class="mt-3">Estatus</label>
    <select name="status" class="input">
        <option value="active">Activa</option>
        <option value="inactive">Inactiva</option>
    </select>

    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded w-full">Registrar</button>
</form>
@endsection
