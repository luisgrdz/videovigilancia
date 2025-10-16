@extends('components/layouts.base')
@section('titulo', 'Panel de Usuario')

@section('contenido')
<h2>Bienvenido, {{ Auth::user()->name }}</h2>
<p>Este es tu panel de usuario.</p>
@endsection
