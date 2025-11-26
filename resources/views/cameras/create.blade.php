@extends('components.layouts.app')

@section('titulo', 'Registrar cámara')

@section('contenido')

    @php
        $userRole = Auth::user()->role->name ?? 'user';
        $prefix = match ($userRole) {
            'admin' => 'admin.',
            'supervisor' => 'supervisor.',
            'mantenimiento' => 'mantenimiento.',
            default => 'user.',
        };
    @endphp

    <div class="max-w-2xl mx-auto">

        <div class="mb-6">
            <a href="{{ route($prefix . 'cameras.index') }}"
                class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-600 transition-colors duration-200 font-medium group">
                <div
                    class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm group-hover:shadow-md transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                <span>Volver al listado</span>
            </a>
        </div>

        {{-- Tarjeta Principal Glass --}}
        {{-- REEMPLAZA LA LÍNEA DEL DIV "glass-panel" POR ESTA: --}}
<div class="glass-panel bg-white/80 dark:bg-gray-800/80 dark:border-gray-700 backdrop-blur-xl border border-white/50 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden relative">
            {{-- Decoración superior --}}
            <div class="h-2 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

            <div class="p-8 sm:p-10">

                {{-- Encabezado --}}
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-3 bg-indigo-50 rounded-2xl text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Registrar Cámara</h1>
                        <p class="text-gray-500 text-sm">Ingresa los detalles técnicos del nuevo dispositivo.</p>
                    </div>
                </div>

                {{-- Formulario --}}
                {{-- resources/views/cameras/create.blade.php --}}

<form method="POST" action="{{ route($prefix . 'cameras.store') }}">
    @csrf

    <div class="space-y-6">
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nombre del Dispositivo</label>
            <input type="text" name="name" required 
                class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500/20 transition-all outline-none text-gray-900 dark:text-white placeholder-gray-400" 
                placeholder="Ej: Cámara Entrada">
        </div>

        <div class="bg-indigo-50/50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800">
            <label class="block text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-3">Paso 1: ¿Qué vas a conectar?</label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <label class="cursor-pointer">
                    <input type="radio" name="camera_type" value="phone" class="peer sr-only" checked onchange="updatePlaceholder('phone')">
                    <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl peer-checked:border-indigo-500 peer-checked:ring-2 peer-checked:ring-indigo-500/20 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all text-center shadow-sm">
                        <span class="text-3xl block mb-2">📱</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">Celular (App)</span>
                    </div>
                </label>
                
                <label class="cursor-pointer">
                    <input type="radio" name="camera_type" value="esp32" class="peer sr-only" onchange="updatePlaceholder('esp32')">
                    <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl peer-checked:border-indigo-500 peer-checked:ring-2 peer-checked:ring-indigo-500/20 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all text-center shadow-sm">
                        <span class="text-3xl block mb-2">🤖</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">ESP32-CAM</span>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="camera_type" value="youtube" class="peer sr-only" onchange="updatePlaceholder('youtube')">
                    <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl peer-checked:border-indigo-500 peer-checked:ring-2 peer-checked:ring-indigo-500/20 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all text-center shadow-sm">
                        <span class="text-3xl block mb-2">🔴</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">Demo YouTube</span>
                    </div>
                </label>
            </div>
        </div>

        <div>
            <label id="inputLabel" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Dirección IP Completa</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="ip" 
                    id="ipInput"
                    required 
                    class="w-full pl-11 pr-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 focus:bg-white dark:focus:bg-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none text-gray-700 dark:text-white font-mono text-sm placeholder-gray-400" 
                    placeholder="http://192.168.1.50:8080/video"
                >
            </div>
            <p id="helperText" class="text-xs text-gray-500 dark:text-gray-400 mt-2 ml-1">
                Copia la dirección que aparece en la App "IP Webcam".
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Estatus</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-white outline-none focus:border-indigo-500">
                    <option value="1">Activa (Encendida)</option>
                    <option value="0">Inactiva (Apagada)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Ubicación</label>
                <input type="text" name="location" class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-white outline-none focus:border-indigo-500" placeholder="Ej: Pasillo">
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Grupo (Opcional)</label>
            <input type="text" name="group" class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-white outline-none focus:border-indigo-500" placeholder="Ej: Oficina Principal">
        </div>

        <div class="pt-4">
            <button class="w-full py-4 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 transform transition hover:-translate-y-1 text-lg">
                Guardar Dispositivo
            </button>
        </div>
    </div>
</form>

                <script>
    function updatePlaceholder(type) {
        const input = document.getElementById('ipInput');
        const label = document.getElementById('inputLabel');
        const helper = document.getElementById('helperText');

        if (type === 'phone') {
            label.innerText = 'Dirección IP del Celular';
            input.placeholder = 'http://192.168.1.X:8080/video';
            helper.innerText = 'Usa la dirección "http" que te da la app IP Webcam terminada en /video';
        } else if (type === 'esp32') {
            label.innerText = 'IP de la ESP32-CAM';
            input.placeholder = '192.168.1.X';
            helper.innerText = 'Solo escribe la IP numérica. El sistema agrega :81/stream automáticamente.';
        } else if (type === 'youtube') {
            label.innerText = 'Enlace de YouTube';
            input.placeholder = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
            helper.innerText = 'Pega el link normal del video. Se reproducirá automáticamente sin controles.';
        }
    }
    updatePlaceholder('phone');
</script>
            </div>
        </div>
    </div>

@endsection