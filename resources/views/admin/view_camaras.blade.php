@extends('components.layouts.base')

@section('titulo', 'Lista de Cámaras')

@section('contenido')
<div class="space-y-6">

    <!-- Título y acción -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h2 class="text-3xl font-bold text-gray-900">Cámaras</h2>
        <a href="{{ route('cameras.add') }}" class="inline-flex items-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
            📹 Agregar Nueva Cámara
        </a>
    </div>

    <!-- Grid de cámaras -->
    @if($cameras->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($cameras as $camera)
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 flex flex-col justify-between hover:shadow-lg transition">
            <!-- Cabecera cámara -->
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-gray-200 rounded-lg w-16 h-16 flex items-center justify-center text-3xl">
                    📹
                </div>
                <div>
                    <p class="font-semibold text-gray-900 text-lg">{{ $camera->name ?? 'Sin nombre' }}</p>
                    <p class="text-sm text-gray-500">{{ $camera->ip }}</p>
                    @if($camera->location)
                        <p class="text-sm text-gray-400">{{ $camera->location }}</p>
                    @endif
                </div>
            </div>

            <!-- Estado -->
            <div class="flex justify-between items-center mt-4">
                @if(($camera->status ?? true))
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <span class="w-2 h-2 bg-green-600 rounded-full mr-2"></span>
                    Online
                </span>
                @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <span class="w-2 h-2 bg-red-600 rounded-full mr-2"></span>
                    Offline
                </span>
                @endif

                <a href="{{ route('cameras.show', $camera->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                    Ver en vivo
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-gray-500">No hay cámaras registradas.</p>
    @endif

</div>
@endsection
