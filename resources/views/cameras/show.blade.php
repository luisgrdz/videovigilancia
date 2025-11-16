@extends('components.layouts.app')

@section('titulo',$camera->name)

@section('contenido')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">

    <h1 class="text-2xl font-bold">{{ $camera->name }}</h1>

    <p class="mt-2 text-gray-700"><strong>IP:</strong> {{ $camera->ip }}</p>
    <p class="mt-1"><strong>Ubicación:</strong> {{ $camera->location }}</p>
    <p class="mt-1"><strong>Estado:</strong> {{ $camera->status }}</p>

    <div class="flex gap-3 mt-4">
        <a href="{{ route('cameras.edit', $camera) }}" class="text-blue-600">Editar</a>

        <form action="{{ route('cameras.destroy', $camera) }}" method="POST">
            @csrf @method('DELETE')
            <button class="text-red-600">Eliminar</button>
        </form>
    </div>

</div>
@endsection
