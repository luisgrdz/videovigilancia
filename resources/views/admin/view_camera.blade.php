@extends('components.layouts.base')

@section('titulo', 'Ver Cámara')

@section('contenido')
<h2>{{ $camera->name ?? $camera->ip }}</h2>
<iframe src="http://{{ $camera->ip }}" width="640" height="480"></iframe>
<p>Transmisión en vivo desde la cámara</p>
@endsection
