@extends('components.layouts.base')

@section('titulo', 'Inicio')

@section('contenido')
    <div class="row mb-4">
        <!-- Card: Cámaras activas -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cámaras Activas</h5>
                    <p class="card-text display-5">{{ $camaras_activas ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Grabaciones recientes -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Grabaciones Recientes</h5>
                    <p class="card-text display-5">{{ $grabaciones_recientes ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Alertas recientes -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Alertas Recientes</h5>
                    <p class="card-text display-5">{{ $alertas_recientes ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Estado del sistema -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Estado del Sistema</h5>
                    <p class="card-text">{{ $estado_sistema ?? 'Estable' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas grabaciones -->
    <h4>Últimas Grabaciones</h4>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Cámara</th>
                <th>Fecha y Hora</th>
                <th>Duración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ultimas_grabaciones ?? [] as $grabacion)
                <tr>
                    <td>{{ $grabacion['camara'] }}</td>
                    <td>{{ $grabacion['fecha'] }}</td>
                    <td>{{ $grabacion['duracion'] }}</td>
                    <td>
                        <a href="{{ $grabacion['url'] }}" class="btn btn-sm btn-primary">Ver</a>
                        <a href="{{ $grabacion['url'] }}" download class="btn btn-sm btn-success">Descargar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Alertas recientes -->
    <h4>Alertas Recientes</h4>
    <ul class="list-group">
        @foreach($ultimas_alertas ?? [] as $alerta)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $alerta['mensaje'] }} - <small>{{ $alerta['fecha'] }}</small>
                <span class="badge bg-danger rounded-pill">{{ $alerta['nivel'] }}</span>
            </li>
        @endforeach
    </ul>
@endsection
