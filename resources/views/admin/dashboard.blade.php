@extends('components/layouts.base')

@section('titulo', 'Panel de Control')

@section('contenido')
<div class="space-y-8">

    <!-- Título y Acciones -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <h2 class="text-3xl font-bold text-gray-900">Panel de Control</h2>
        <div class="flex gap-3">
            <a href="{{ route('users.add') }}" class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                👤 Agregar Personal
            </a>
            <a href="{{ route('cameras.add') }}" class="inline-flex items-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                📹 Agregar Cámara
            </a>
        </div>
    </div>

    <!-- Estadísticas principales -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between border border-gray-100">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Cámaras</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $cameras->count() ?? 0 }}</p>
            </div>
            <div class="bg-blue-100 p-4 rounded-full text-2xl">📹</div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between border border-gray-100">
            <div>
                <p class="text-sm font-medium text-gray-500">Personal Activo</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $users->count() ?? 0 }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded-full text-2xl">👤</div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between border border-gray-100">
            <div>
                <p class="text-sm font-medium text-gray-500">Cámaras Online</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $cameras->where('status', true)->count() ?? 0 }}</p>
            </div>
            <div class="bg-emerald-100 p-4 rounded-full text-2xl">✅</div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6 flex items-center justify-between border border-gray-100">
            <div>
                <p class="text-sm font-medium text-gray-500">Alertas Hoy</p>
                <p class="text-3xl font-bold text-orange-600 mt-2">0</p>
            </div>
            <div class="bg-orange-100 p-4 rounded-full text-2xl">⚠️</div>
        </div>
    </div>

    <!-- Personal del Sistema -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
            <h3 class="text-xl font-semibold text-gray-900">Personal del Sistema</h3>
            <a href="{{ route('users.add') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Ver todos →</a>
        </div>
        <div class="p-6">
            @if($users->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($users as $user)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="bg-blue-500 text-white font-bold rounded-full w-14 h-14 flex items-center justify-center text-lg">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ ucfirst($user->role) }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Activo
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No hay personal registrado</p>
            @endif
        </div>
    </div>

    <!-- Estado de Cámaras -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
            <h3 class="text-xl font-semibold text-gray-900">Estado de Cámaras</h3>
            <a href="{{ route('cameras.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Ver todas →</a>
        </div>
        <div class="p-6">
            @if($cameras->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($cameras->take(5) as $camera)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="bg-gray-200 rounded-lg w-16 h-16 flex items-center justify-center text-2xl">
                                    📹
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $camera->name ?? 'Cámara ' . $loop->iteration }}</p>
                                    <p class="text-sm text-gray-500">{{ $camera->location ?? 'Sin ubicación' }}</p>
                                </div>
                            </div>
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
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    <a href="{{ route('cameras.index') }}" class="block w-full text-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                        Ver todas las cámaras
                    </a>
                </div>
            @else
                <p class="text-gray-500">No hay cámaras registradas</p>
            @endif
        </div>
    </div>

</div>
@endsection
