@extends('components.layouts.app')

@section('titulo', 'Listado de Cámaras')

@section('contenido')

@php
    $isAdmin = Request::is('admin*');
    $prefix = $isAdmin ? 'admin.' : (Request::is('supervisor*') ? 'supervisor.' : (Request::is('mantenimiento*') ? 'mantenimiento.' : 'user.'));
@endphp

<div class="max-w-7xl mx-auto">
    
    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Cámaras</h1>
            <p class="text-gray-500 mt-1">Administración y monitoreo de dispositivos</p>
        </div>

        {{-- Botón Agregar (Visible para Admin y Mantenimiento) --}}
        @if($isAdmin || Auth::user()->role->name === 'mantenimiento')
            <a href="{{ route($prefix . 'cameras.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-1 flex items-center gap-2 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nueva Cámara
            </a>
        @endif
    </div>

    {{-- Tabla / Tarjeta Principal --}}
    <div class="glass-panel bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
        
        {{-- Decoración superior --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-500"></div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Dispositivo</th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Conexión (IP)</th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Ubicación / Grupo</th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Estado</th>
                        <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white/40 divide-y divide-gray-100">
                    @forelse($cameras as $camera)
                    <tr class="hover:bg-white/80 transition-colors duration-200 group">
                        
                        {{-- Nombre --}}
                        <td class="px-8 py-5 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-50 rounded-full flex items-center justify-center text-indigo-500 mr-4 group-hover:bg-indigo-100 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="text-sm font-bold text-gray-800">{{ $camera->name }}</div>
                            </div>
                        </td>

                        {{-- IP --}}
                        <td class="px-8 py-5 whitespace-nowrap">
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-md bg-gray-100 text-gray-600 border border-gray-200 font-mono">
                                {{ $camera->ip }}
                            </span>
                        </td>

                        {{-- Ubicación --}}
                        <td class="px-8 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-600 font-medium">{{ $camera->location ?? '—' }}</div>
                            <div class="text-xs text-gray-400">{{ $camera->group ?? 'Sin grupo' }}</div>
                        </td>

                        {{-- Estado --}}
                        <td class="px-8 py-5 whitespace-nowrap">
                            @if($camera->status)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                    En Línea
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                    Offline
                                </span>
                            @endif
                        </td>

                        {{-- Acciones --}}
                        <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                
                                {{-- Ver --}}
                                <a href="{{ route($prefix . 'cameras.show', $camera) }}" class="p-2 rounded-lg text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all" title="Ver Monitor">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 5 8.268 7.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                {{-- Editar (Admin y Mantenimiento) --}}
                                @if($isAdmin || Auth::user()->role->name === 'mantenimiento')
                                    <a href="{{ route($prefix . 'cameras.edit', $camera) }}" class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Configurar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                @endif

                                {{-- Eliminar (Solo Admin) --}}
                                @if($isAdmin)
                                    <form action="{{ route('admin.cameras.destroy', $camera) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este dispositivo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 rounded-full p-4 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-lg font-medium text-gray-600">No hay cámaras registradas</p>
                                <p class="text-sm text-gray-400">Comienza agregando un nuevo dispositivo al sistema.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if($cameras->hasPages())
            <div class="bg-gray-50/50 px-8 py-4 border-t border-gray-100">
                {{ $cameras->links() }}
            </div>
        @endif
    </div>
</div>

@endsection