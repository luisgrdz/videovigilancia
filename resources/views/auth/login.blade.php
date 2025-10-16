@extends('components/layouts.base')
@section('titulo', 'Iniciar sesión')

@section('contenido')
<div class="card col-md-6 mx-auto">
    <div class="card-body">
        <h4 class="mb-3">Iniciar sesión</h4>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <input type="email" name="email" class="form-control mb-2" placeholder="Correo" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>
            <button class="btn btn-dark w-100">Entrar</button>
        </form>
        <div class="mt-3 text-center">
            <a href="{{ route('register') }}">Registrarse</a>
        </div>
    </div>
</div>
@endsection
