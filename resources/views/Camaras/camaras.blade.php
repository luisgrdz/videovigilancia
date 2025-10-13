@extends('components.layouts.base')

@section('titulo', 'Dashboard - Panel de Cámaras')

@section('contenido')
    <h2>Panel de Cámaras</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Cámara 1 - Entrada</h4>
            <img src="http://192.168.137.181" class="img-fluid border">
        </div>
        <div class="col-md-6">
            <h4>Cámara 2 - Patio</h4>
            <img src="http://192.168.1.102/stream" class="img-fluid border">
        </div>
    </div>
@endsection
