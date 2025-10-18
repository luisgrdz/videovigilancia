@extends('components/layouts.base')

@section('titulo', 'Panel de Control')

@section('contenido')
<h2>Panel de Control</h2>
<a href="{{ route('users.add') }}">Agregar Personal</a> |
<a href="{{ route('cameras.add') }}">Agregar Cámara</a> |
<a href="{{ route('cameras.index') }}">Ver Cámaras</a>

<h3>Personal</h3>
<ul>
    @foreach($users as $user)
        <li>{{ $user->name }} ({{ $user->role }})</li>
    @endforeach
</ul>

<h3>Cámaras</h3>
<ul>
    <a href="{{ route('cameras.index') }}" class="btn btn-primary">Ver todas las cámaras</a>

</ul>
@endsection
