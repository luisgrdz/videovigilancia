@extends('components.layouts.base')

@section('titulo', 'Sistema de Videovigilancia')

@section('contenido')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">Videovigilancia</a>

        <div class="d-flex ms-auto">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Iniciar sesión</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container text-center mt-5">
    <h1>Bienvenido al Sistema de Videovigilancia</h1>
    <p>Por favor inicia sesión para acceder al panel.</p>

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary mt-3">Iniciar sesión</a>
    @endguest
</div>
@endsection
