@extends('components.layouts.app')

@section('titulo','Mi Panel')

@section('contenido')
<h1 class="text-2xl font-bold">Bienvenido, {{ $user->name }}</h1>

<p class="mt-4">Este es tu panel personal.</p>
<div class="flex flex-col gap-4">
    <a href="{{ route('cameras.index') }}" class="btn">Mis Cámaras</a>
    <a href="{{ route('cameras.create') }}" class="btn">Agregar Cámara</a>
</div>

@endsection
