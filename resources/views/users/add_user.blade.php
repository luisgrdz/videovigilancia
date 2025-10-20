@extends('components/layouts.base')
@section('titulo','Agregar Personal')
@section('contenido')

<h2>Agregar Personal</h2>

{{-- Mensajes de éxito --}}

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo" required>
    <select name="role" required>
        <option value="user">Personal</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit">Agregar</button>
</form>

@endsection
