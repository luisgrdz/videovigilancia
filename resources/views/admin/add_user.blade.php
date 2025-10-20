@extends('components/layouts.base')
@section('titulo', 'Agregar Usuario')

@section('contenido')

@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <h4 class="mb-3">Agregar usuario</h4>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <input type="text" name="name" class="form-control mb-2" placeholder="Nombre" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Correo" required>
            <select name="role" class="form-control mb-3" required>
                <option value="user">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
            <button class="btn btn-dark w-100">Crear Usuario</button>
        </form>
    </div>
</div>

@endsection
