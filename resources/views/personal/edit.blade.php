@extends('components.layouts.app')

@section('titulo','Editar usuario')

@section('contenido')
<h1 class="text-xl font-bold mb-4">Editar usuario: {{ $user->name }}</h1>

<form method="POST" action="{{ route('admin.personal.update', $user) }}" class="bg-white p-6 rounded shadow max-w-md">
    @csrf
    @method('PATCH')

    <label>Nombre</label>
    <input class="input" name="name" value="{{ $user->name }}" required>

    <label class="mt-3">Email</label>
    <input class="input" name="email" type="email" value="{{ $user->email }}" required>

    <label class="mt-3">Nueva contraseña (opcional)</label>
    <input class="input" name="password" type="password">

    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded w-full">
        Guardar cambios
    </button>
</form>
@endsection
