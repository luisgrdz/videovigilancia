@extends('components.layouts.base')

@section('titulo', 'Historial de Grabaciones')

@section('contenido')
    <h2>Grabaciones Recientes</h2>
    <ul class="list-group">
        <li class="list-group-item">Cámara 1 - 2025-10-07 10:15 <button class="btn btn-sm btn-primary">Reproducir</button></li>
        <li class="list-group-item">Cámara 2 - 2025-10-07 09:50 <button class="btn btn-sm btn-primary">Reproducir</button></li>
        <!-- Repetir según grabaciones -->
    </ul>
@endsection
