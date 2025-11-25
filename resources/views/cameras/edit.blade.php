@extends('components.layouts.app')

@section('titulo', 'Editar Cámara')

@section('contenido')

@php
    $userRole = Auth::user()->role->name ?? 'user';
    $prefix = match($userRole) {
        'admin' => 'admin.',
        'supervisor' => 'supervisor.',
        'mantenimiento' => 'mantenimiento.',
        default => 'user.',
    };
@endphp

<div class="max-w-2xl mx-auto">
    
    {{-- Botón Volver --}}
    <div class="mb-6">
        <a href="{{ route($prefix . 'cameras.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-600 transition-colors duration-200 font-medium group">
            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm group-hover:shadow-md transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
            <span>Volver al listado</span>
        </a>
    </div>

    {{-- Tarjeta Principal --}}
    <div class="glass-panel bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden relative">
        
        {{-- Decoración superior --}}
        <div class="h-2 w-full bg-gradient-to-r from-yellow-500 via-orange-500 to-red-500"></div>

        <div class="p-8 sm:p-10">
            
            {{-- Encabezado --}}
            <div class="flex items-center gap-4 mb-8">
                <div class="p-3 bg-yellow-50 rounded-2xl text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Editar Dispositivo</h1>
                    <p class="text-gray-500 text-sm">Actualizando configuración de <span class="font-semibold">{{ $camera->name }}</span></p>
                </div>
            </div>

            {{-- Formulario --}}
            <form method="POST" action="{{ route($prefix . 'cameras.update', $camera) }}">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    
                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Dispositivo</label>
                        <input type="text" name="name" value="{{ old('name', $camera->name) }}" required 
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none text-gray-700 placeholder-gray-400">
                    </div>

                    <!-- Grid IP y Estado -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- IP -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Dirección IP / URL</label>
                            <input type="text" name="ip" value="{{ old('ip', $camera->ip) }}" required 
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none text-gray-700 font-mono text-sm">
                        </div>

                        <!-- Estatus -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Estado Operativo</label>
                            <div class="relative">
                                <select name="status" 
                                    class="w-full pl-4 pr-10 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none text-gray-700 appearance-none cursor-pointer">
                                    <option value="1" {{ $camera->status ? 'selected' : '' }}>Activa</option>
                                    <option value="0" {{ !$camera->status ? 'selected' : '' }}>Inactiva</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ubicación y Grupo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Ubicación -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Ubicación Física</label>
                            <input type="text" name="location" value="{{ old('location', $camera->location) }}" 
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none text-gray-700">
                        </div>

                        <!-- Grupo -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Grupo / Zona</label>
                            <input type="text" name="group" value="{{ old('group', $camera->group) }}" 
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none text-gray-700"
                                placeholder="Ej: Planta Baja">
                        </div>
                    </div>

                    {{-- CAMPO REASIGNAR DUEÑO (ADMIN Y MANTENIMIENTO) --}}
                    @if(($userRole === 'admin' || $userRole === 'mantenimiento') && isset($users))
                        <div class="pt-4 border-t border-gray-100">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Propietario Asignado (Reasignar)
                                </span>
                            </label>
                            <div class="relative">
                                <select name="user_id" 
                                    class="w-full pl-4 pr-10 py-3 rounded-xl bg-indigo-50 border border-indigo-100 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none text-gray-700 appearance-none cursor-pointer">
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}" {{ $camera->user_id == $u->id ? 'selected' : '' }}>
                                            {{ $u->name }} ({{ $u->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-indigo-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 ml-1">Selecciona un nuevo usuario para transferir esta cámara.</p>
                        </div>
                    @endif

                    <!-- Botón Submit -->
                    <div class="pt-4">
                        <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg shadow-yellow-500/30 transform transition hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection