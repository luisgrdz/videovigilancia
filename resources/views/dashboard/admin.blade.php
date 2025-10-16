@extends('components/layouts.base')
@section('titulo', 'Panel de Administrador')

@section('contenido')
<h2>Bienvenido, {{ Auth::user()->name }} (Administrador)</h2>
<p>Desde aquí puedes gestionar usuarios, roles y configuraciones.</p>
@endsection
