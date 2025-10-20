@extends('components.layouts.base')

@section('titulo', 'Cambiar Contraseña')

@section('contenido')
<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <h4 class="mb-3">Cambia tu contraseña</h4>

        <form method="POST" action="{{ route('password.change.post') }}">
            @csrf
            <input type="password" name="password" class="form-control mb-2" placeholder="Nueva contraseña" required>
            <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirmar contraseña" required>
            <button class="btn btn-success w-100">Guardar</button>
        </form>
    </div>
</div>
@endsection
