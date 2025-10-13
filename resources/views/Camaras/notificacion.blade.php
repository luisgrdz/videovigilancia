@extends('components.layouts.base')

@section('titulo', 'Alertas de Seguridad')

@section('contenido')
    <h2>Eventos Recientes</h2>
    <ul class="list-group">
        <li class="list-group-item">Cámara 1 - Movimiento detectado - 2025-10-07 10:30
            <button class="btn btn-sm btn-primary">Ver</button>
        </li>
        <li class="list-group-item">Cámara 2 - Movimiento detectado - 2025-10-07 09:50
            <button class="btn btn-sm btn-primary">Ver</button>
        </li>
    </ul>
@endsection
