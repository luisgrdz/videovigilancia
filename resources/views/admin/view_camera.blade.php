@extends('components.layouts.base')

@section('titulo', $camera->name ?? $camera->ip)

@section('contenido')
<div class="flex flex-col items-center space-y-6">

    <!-- Título de la cámara -->
    <div class="w-full max-w-3xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h2 class="text-3xl font-bold text-gray-900">{{ $camera->name ?? 'Cámara ' . $camera->id }}</h2>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                     {{ ($camera->status ?? true) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            <span class="w-2 h-2 rounded-full mr-2 {{ ($camera->status ?? true) ? 'bg-green-600' : 'bg-red-600' }}"></span>
            {{ ($camera->status ?? true) ? 'Online' : 'Offline' }}
        </span>
    </div>

    <!-- Video / Transmisión -->
    <div class="w-full max-w-4xl bg-gray-100 rounded-2xl shadow-lg overflow-hidden">
        <iframe 
            src="http://{{ $camera->ip }}" 
            class="w-full h-96 md:h-[500px] border-0 rounded-2xl"
            allowfullscreen
        ></iframe>
    </div>

    <!-- Información adicional -->
    <div class="w-full max-w-3xl bg-white rounded-xl shadow p-6 border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <p class="text-gray-600"><strong>IP:</strong> {{ $camera->ip }}</p>
            @if($camera->location)
            <p class="text-gray-600"><strong>Ubicación:</strong> {{ $camera->location }}</p>
            @endif
            <p class="text-gray-600"><strong>ID:</strong> {{ $camera->id }}</p>
        </div>
        <div class="flex gap-3 mt-3 md:mt-0">
            <a href="{{ route('cameras.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-900 font-medium rounded-lg transition">
                ← Volver a todas
            </a>
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                🔄 Reiniciar cámara
            </button>
            <button onclick="window.open('http://{{ $camera->ip }}', '_blank')" 
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                📺 Pantalla completa
            </button>
        </div>
    </div>

    <!-- Descripción / Mensaje adicional -->
    <p class="text-gray-500 text-center max-w-3xl">
        Transmisión en vivo desde la cámara. Usa los botones para administrar o visualizar en pantalla completa.
    </p>

</div>
@endsection
