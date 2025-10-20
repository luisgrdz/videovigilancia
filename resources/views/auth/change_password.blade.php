@extends('components/layouts.base_login')
@section('titulo', 'Cambiar contraseña')

@section('contenido')

@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <h4 class="mb-3">Cambiar contraseña</h4>
        <form action="{{ route('password.change.post') }}" method="POST">
            @csrf
            <input type="password" name="password" class="form-control mb-2" placeholder="Nueva contraseña" required>
            <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirmar contraseña" required>
            <button class="btn btn-dark w-100">Actualizar contraseña</button>
        </form>
    </div>
</div>

@endsection
