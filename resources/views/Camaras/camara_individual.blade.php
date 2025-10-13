@extends('components.layouts.base')

@section('titulo', 'Cámara Individual')

@section('contenido')
    <h2>Vista de Cámara</h2>
    <div class="mb-3">
        <img src="{{ $camera_stream_url }}" class="img-fluid border">
    </div>
    <button class="btn btn-primary">Tomar Foto</button>
    <button class="btn btn-success">Activar Grabación</button>
@endsection
