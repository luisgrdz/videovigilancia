@extends('components.layouts.base')

@section('titulo', 'Lista de Cámaras')

@section('contenido')
<h2>Cámaras</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>IP</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cameras as $camera)
        <tr>
            <td>{{ $camera->id }}</td>
            <td>{{ $camera->name ?? 'Sin nombre' }}</td>
            <td>{{ $camera->ip }}</td>
            <td>
                <a href="{{ route('cameras.show', $camera->id) }}" class="btn btn-primary btn-sm">Ver en vivo</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
