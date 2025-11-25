@extends('components.layouts.app')

@section('titulo', 'Área Técnica')

@section('contenido')

<div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Área Técnica</h1>
        <p class="text-gray-500 mt-1">Gestión de infraestructura y mantenimiento de dispositivos.</p>
    </div>
    <div class="bg-amber-100 text-amber-700 px-4 py-1 rounded-full text-sm font-semibold border border-amber-200 flex items-center gap-2">
        <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
        Soporte Técnico
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
    
    <!-- TARJETA ESTADO DEL SISTEMA -->
    <div class="glass-panel rounded-2xl p-8 border-l-4 border-amber-500">
        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
            </svg>
            Estado del Sistema
        </h3>

        <div class="space-y-4">
            <div class="flex justify-between items-center p-3 bg-white/50 rounded-lg border border-white/60">
                <span class="text-gray-600 font-medium">Total Dispositivos</span>
                <span class="text-xl font-bold text-gray-800">{{ $totalCameras }}</span>
            </div>
            
            <div class="flex justify-between items-center p-3 bg-white/50 rounded-lg border border-white/60">
                <span class="text-gray-600 font-medium">Cámaras Offline</span>
                <span class="text-xl font-bold {{ $offlineCameras > 0 ? 'text-red-600' : 'text-green-600' }}">{{ $offlineCameras }}</span>
            </div>
        </div>

        <div class="mt-6">
            @if($offlineCameras > 0)
                <div class="p-4 bg-red-50 text-red-700 rounded-xl border border-red-100 flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="text-sm font-medium">Atención requerida: {{ $offlineCameras }} cámaras presentan fallos de conexión.</span>
                </div>
            @else
                <div class="p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">Sistema estable. Todos los dispositivos operativos.</span>
                </div>
            @endif
        </div>
    </div>

    <!-- TARJETA ACCIONES -->
    <div class="glass-panel rounded-2xl p-8 flex flex-col justify-center">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Herramientas de Gestión</h3>
        
        <div class="grid gap-4">
            <a href="{{ route('mantenimiento.cameras.create') }}" class="group flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-blue-400 hover:shadow-md transition-all">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-50 p-3 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <span class="block font-bold text-gray-700">Registrar Cámara</span>
                        <span class="text-xs text-gray-500">Añadir nuevo hardware</span>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300 group-hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="{{ route('mantenimiento.cameras.index') }}" class="group flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-amber-400 hover:shadow-md transition-all">
                <div class="flex items-center gap-4">
                    <div class="bg-amber-50 p-3 rounded-lg text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <span class="block font-bold text-gray-700">Inventario</span>
                        <span class="text-xs text-gray-500">Editar configuraciones</span>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300 group-hover:text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>

@endsection