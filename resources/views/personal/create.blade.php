@extends('components.layouts.app')

@section('titulo','Crear usuario')

@section('contenido')
<h1 class="text-xl font-bold mb-4">Registrar nuevo usuario</h1>

<form method="POST" action="{{ route('admin.personal.store') }}" class="bg-white p-6 rounded shadow max-w-md">
    @csrf

    <label>Nombre</label>
    <input class="input" name="name" required>

    <label class="mt-3">Email</label>
    <input class="input" name="email" type="email" required>

    <label class="mt-3">Contraseña</label>
    <input class="input" name="password" type="password" required>

    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded w-full">
        Crear
    </button>
</form>
@endsection
