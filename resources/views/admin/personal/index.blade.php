@extends('components.layouts.base')

@section('titulo', 'Gestión de Personal')

@section('contenido')
<div class="space-y-6">

    <!-- Título y botón agregar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h2 class="text-3xl font-bold text-gray-900">Personal del Sistema</h2>
        <a href="{{ route('users.add') }}" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
            👤 Agregar Nuevo Usuario
        </a>
    </div>

    <!-- Lista de personal -->
    @if($users->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($users as $user)
        <div class="bg-white shadow rounded-xl border border-gray-200 p-6 flex flex-col justify-between hover:shadow-lg transition">
            <div class="flex items-center gap-4">
                <!-- Avatar inicial -->
                <div class="bg-blue-500 text-white font-bold rounded-full w-12 h-12 flex items-center justify-center text-xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ ucfirst($user->role) }}</p>
                </div>
            </div>

            <!-- Estado y acciones -->
            <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
                <!-- Estado activo/bloqueado -->
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                             {{ $user->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $user->active ? 'Activo' : 'Bloqueado' }}
                </span>

                <!-- Botones de acción -->
                <div class="flex gap-2">
                    <!-- Editar usuario -->
                    <a href="{{ route('users.edit', $user->id) }}" 
                       class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 rounded-lg transition">
                        ✏️ Editar
                    </a>

                    <!-- Bloquear / desbloquear -->
                    <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="px-3 py-1 text-sm {{ $user->active ? 'bg-red-200 text-red-800 hover:bg-red-300' : 'bg-green-200 text-green-800 hover:bg-green-300' }} rounded-lg transition">
                            {{ $user->active ? 'Bloquear' : 'Activar' }}
                        </button>
                    </form>

                    <!-- Eliminar -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white hover:bg-red-700 rounded-lg transition">
                            🗑 Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <p class="text-gray-500">No hay personal registrado aún.</p>
    @endif
</div>
@endsection
