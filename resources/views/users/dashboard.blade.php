@extends('components/layouts.base')

@section('titulo', 'Dashboard Usuario')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Bienvenido, {{ auth()->user()->name }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Información de tu cuenta</h5>
            <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Correo:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Rol:</strong> {{ auth()->user()->role }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Cámaras disponibles</h5>
            <p>Puedes visualizar todas las cámaras asignadas a tu usuario desde aquí.</p>
            {{-- <a href="{{ route('users.cameras') }}" class="btn btn-primary">Ver Cámaras</a> --}}
        </div>
    </div>
</div>
@endsection
