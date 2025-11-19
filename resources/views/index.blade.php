@extends('components.layouts.app')

@section('titulo', 'Inicio - Videovigilancia')

@section('contenido')

<div class="max-w-6xl mx-auto">

    {{-- HERO SECTION: Bienvenida --}}
    <div class="text-center mb-16 fade-up relative">
        
        <!-- Decoración de fondo para el título -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-32 bg-indigo-400/20 rounded-full blur-3xl -z-10"></div>

        <h1 class="text-5xl font-bold mb-6 text-gray-800 tracking-tight">
            Bienvenido al <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Sistema de Seguridad</span>
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Plataforma centralizada para el monitoreo y gestión de dispositivos. Revisa a continuación las novedades y protocolos vigentes para una operación segura.
        </p>

        @guest
            <div class="mt-8">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white rounded-full btn-gradient hover:scale-105 transform transition duration-300">
                    Acceder al Sistema
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        @endguest
    </div>

    {{-- GRID DE TARJETAS INFORMATIVAS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- 1. CONSEJO DE SEGURIDAD (Azul/Índigo) --}}
        <div class="glass-panel rounded-3xl p-1 overflow-hidden transition duration-300 hover:-translate-y-2 hover:shadow-xl group">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50/50 h-full rounded-[1.3rem] p-8 relative">
                <!-- Icono flotante -->
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-800 mb-3">Consejo de Seguridad</h3>
                <p class="text-gray-600 leading-relaxed">
                    Verifica periódicamente las cámaras críticas para asegurarte de que no haya fallos de conexión o áreas ciegas sin cobertura.
                </p>
                
                <!-- Barra decorativa inferior -->
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </div>

        {{-- 2. ALERTA IMPORTANTE (Rojo/Naranja) --}}
        <div class="glass-panel rounded-3xl p-1 overflow-hidden transition duration-300 hover:-translate-y-2 hover:shadow-xl group">
            <div class="bg-gradient-to-br from-red-50 to-orange-50/50 h-full rounded-[1.3rem] p-8 relative">
                <!-- Icono flotante -->
                <div class="w-14 h-14 bg-red-100 text-red-500 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-3">Alerta Importante</h3>
                <p class="text-gray-600 leading-relaxed">
                    Si se detecta movimiento fuera del horario establecido, <span class="font-semibold text-red-500">notifica inmediatamente</span> al supervisor de turno mediante el protocolo de emergencia.
                </p>

                <!-- Barra decorativa inferior -->
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </div>

        {{-- 3. RECORDATORIO DIARIO (Verde/Esmeralda) --}}
        <div class="glass-panel rounded-3xl p-1 overflow-hidden transition duration-300 hover:-translate-y-2 hover:shadow-xl group">
            <div class="bg-gradient-to-br from-green-50 to-emerald-50/50 h-full rounded-[1.3rem] p-8 relative">
                <!-- Icono flotante -->
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-3">Recordatorio Diario</h3>
                <p class="text-gray-600 leading-relaxed">
                    Mantén los accesos principales desbloqueados únicamente para el personal autorizado y revisa el estado de los sensores al finalizar el turno.
                </p>

                <!-- Barra decorativa inferior -->
                <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-green-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </div>

    </div>

    {{-- FOOTER SIMPLIFICADO --}}
    <div class="mt-16 text-center border-t border-gray-200/50 pt-8">
        <p class="text-sm text-gray-400">
            ¿Necesitas reportar un incidente técnico? <a href="#" class="text-indigo-500 hover:text-indigo-700 font-medium transition">Contactar Soporte</a>
        </p>
    </div>

</div>

@endsection