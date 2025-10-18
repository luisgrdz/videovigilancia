@extends('components/layouts.base')
@section('titulo','Agregar Cámara')
@section('contenido')
<h2>Agregar Cámara</h2>
<form action="{{ route('cameras.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nombre opcional">
    <input type="text" name="ip" placeholder="IP de la cámara" required>
    <button type="submit">Agregar Cámara</button>
</form>
@endsection
