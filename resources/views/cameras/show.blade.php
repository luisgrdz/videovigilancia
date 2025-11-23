@extends('components.layouts.app')

@section('titulo', 'Monitor en Vivo')

@section('contenido')
<div class="max-w-6xl mx-auto mt-6">

    @php
        $prefix = Request::is('admin*') ? 'admin.' : 'user.';
        
        // --- LÓGICA INTELIGENTE PARA LA URL ---
        $ip = trim($camera->ip);
        
        // Caso 1: Si el usuario escribió una URL completa (ej: http://192.168.1.50:8080/video)
        if (str_starts_with($ip, 'http')) {
            $streamUrl = $ip;
        } 
        // Caso 2: Si solo puso la IP y es la app "IP Webcam" (puerto 8080 por defecto)
        // Intenta adivinar que es un celular si usas el puerto 8080
        elseif (str_contains($ip, ':8080')) {
            $streamUrl = "http://{$ip}/video";
        }
        // Caso 3: Asumimos que es una ESP32 estándar (puerto 81) si no se especifica nada más
        else {
            $streamUrl = "http://{$ip}:81/stream";
        }
    @endphp

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                {{ $camera->name }}
                <span class="px-3 py-1 text-xs rounded-full {{ $camera->status ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                    {{ $camera->status ? 'EN LÍNEA' : 'OFFLINE' }}
                </span>
            </h1>
            <p class="text-gray-500 text-sm mt-1">
                {{ $camera->location ?? 'Ubicación no definida' }} • 
                <span class="font-mono bg-gray-100 px-1 rounded">{{ $camera->ip }}</span>
            </p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route($prefix . 'cameras.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors shadow-sm">
                &larr; Volver
            </a>
            <a href="{{ route($prefix . 'cameras.edit', $camera) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium shadow-md transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Configurar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-black rounded-xl overflow-hidden shadow-2xl border-4 border-gray-800 relative group aspect-video">
                @if($camera->status)
                    <img 
                        src="{{ $streamUrl }}" 
                        class="w-full h-full object-contain bg-black"
                        alt="Video en vivo de {{ $camera->name }}"
                        onerror="document.getElementById('video-error').classList.remove('hidden'); this.style.display='none';"
                    >

                    <div id="video-error" class="hidden absolute inset-0 flex flex-col items-center justify-center bg-gray-900 text-white p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-red-500 mb-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        <h3 class="text-xl font-bold mb-1">No se puede conectar a la cámara</h3>
                        <p class="text-gray-400 mb-4">Intentando conectar a: <br><span class="font-mono bg-gray-800 px-2 py-1 rounded text-sm text-yellow-500">{{ $streamUrl }}</span></p>
                        <div class="text-left text-sm bg-gray-800 p-4 rounded border border-gray-700 inline-block">
                            <p class="font-bold text-gray-300 mb-2">Posibles soluciones:</p>
                            <ul class="list-disc pl-4 space-y-1 text-gray-400">
                                <li>Asegúrate de que el celular tenga la app abierta.</li>
                                <li>Verifica que tu PC y el celular estén en la <strong>misma red Wi-Fi</strong>.</li>
                                <li>Revisa si la IP ha cambiado en la app del celular.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded animate-pulse shadow-lg">
                        ● EN VIVO
                    </div>
                @else
                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-800 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mb-2 opacity-25">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                        </svg>
                        <span class="font-medium text-lg">Cámara desactivada</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Información Técnica</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Grupo de Vigilancia</label>
                        <p class="text-gray-700 font-medium">{{ $camera->group ?? 'General' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Última Actualización</label>
                        <p class="text-gray-700 text-sm">{{ $camera->updated_at->diffForHumans() }}</p>
                    </div>

                    <div class="pt-2">
                        <a href="{{ $streamUrl }}" target="_blank" class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                            Abrir stream en pestaña nueva
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600 mt-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <div>
                        <h4 class="font-bold text-blue-900 text-sm">¿Usando un celular?</h4>
                        <p class="text-blue-800 text-xs mt-1 leading-relaxed">
                            Si usas la app <strong>IP Webcam</strong>, asegúrate de que al crear la cámara hayas puesto la dirección completa así: <br>
                            <span class="font-mono bg-white/50 px-1 rounded text-blue-950">http://192.168.X.X:8080/video</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection