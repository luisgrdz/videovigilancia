@extends('components.layouts.app')

@section('titulo', 'Monitor en Vivo')

@section('contenido')
<div class="max-w-6xl mx-auto mt-6">

    @php
        $prefix = Request::is('admin*') ? 'admin.' : 'user.';
        $ip = trim($camera->ip);
        $isYoutube = false;
        $streamUrl = '';

        // --- DETECTOR DE TIPO DE CÁMARA ---
        
        // 1. Detectar YouTube
        if (str_contains($ip, 'youtube.com') || str_contains($ip, 'youtu.be')) {
            $isYoutube = true;
            // Convertir link normal a Embed + Parámetros de restricción
            // Extraer ID del video
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $ip, $match);
            $videoId = $match[1] ?? null;
            // Url final con autoplay, sin controles, sin teclado, sin branding
            $streamUrl = "https://www.youtube.com/embed/{$videoId}?autoplay=1&controls=0&disablekb=1&modestbranding=1&rel=0&loop=1&playlist={$videoId}&mute=1";
        }
        // 2. Detectar Celular (URL completa)
        elseif (str_starts_with($ip, 'http')) {
            $streamUrl = $ip;
        } 
        // 3. Detectar Celular (IP + Puerto)
        elseif (str_contains($ip, ':8080')) {
            $streamUrl = "http://{$ip}/video";
        }
        // 4. Por defecto: ESP32
        else {
            $streamUrl = "http://{$ip}:81/stream";
        }
    @endphp

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                {{ $camera->name }}
                @if($isYoutube)
                    <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded border border-red-200 font-bold">DEMO YOUTUBE</span>
                @endif
            </h1>
            <p class="text-gray-500 text-sm">{{ $camera->location ?? 'Sin ubicación' }}</p>
        </div>
        <a href="{{ route($prefix . 'cameras.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Volver</a>
    </div>

    <div class="bg-black rounded-xl overflow-hidden shadow-2xl border-4 border-gray-800 relative aspect-video group">
        @if($camera->status)
            
            @if($isYoutube)
                <div class="w-full h-full pointer-events-none"> <iframe 
                        src="{{ $streamUrl }}" 
                        class="w-full h-full" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            @else
                <img 
                    src="{{ $streamUrl }}" 
                    class="w-full h-full object-contain"
                    alt="Video en vivo"
                    onerror="this.style.display='none'; document.getElementById('error-msg').classList.remove('hidden');"
                >
                <div id="error-msg" class="hidden absolute inset-0 flex flex-col items-center justify-center text-white">
                    <p class="text-xl font-bold text-red-500">Sin señal</p>
                    <p class="text-sm text-gray-400">Verifica la conexión</p>
                </div>
            @endif

        @else
            <div class="absolute inset-0 flex items-center justify-center text-gray-500 font-mono">
                [ DISPOSITIVO APAGADO ]
            </div>
        @endif
    </div>
</div>
@endsection