@extends('components.layouts.app')

@section('titulo','Dashboard Admin')

@section('contenido')
<h1 class="text-3xl font-bold mb-6">Panel de Administrador</h1>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold">Usuarios registrados</h3>
        <p class="text-3xl font-black">{{ $totalUsers }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold">Cámaras</h3>
        <p class="text-3xl font-black">{{ $totalCameras }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold">Cámaras activas</h3>
        <p class="text-3xl font-black">{{ $activeCameras }}</p>
    </div>

    <div class="flex flex-col gap-4">
    <a href="{{ route('admin.personal.index') }}" class="btn">Administrar Personal</a>
    <a href="{{ route('admin.personal.create') }}" class="btn">Agregar Personal</a>
    <a href="{{ route('admin.cameras.index') }}" class="btn">Administrar Cámaras</a>
    <a href="{{ route('admin.cameras.create') }}" class="btn">Agregar Cámara</a>
</div>


</div>
@endsection
