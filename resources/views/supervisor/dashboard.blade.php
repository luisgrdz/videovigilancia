<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                    Panel de Supervisor - Bienvenid@, {{ $supervisor->name }}
                </h2>

                <p class="text-gray-600 mb-6">
                    Este es tu panel de control como Supervisor. Tienes acceso a funcionalidades
                    de monitoreo y gestión de personal y cámaras.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tarjeta de Monitoreo -->
                    <div class="bg-indigo-50 border-l-4 border-indigo-500 rounded-lg p-5 shadow-md">
                        <div class="text-lg font-bold text-indigo-700">Monitoreo de Cámaras</div>
                        <p class="text-sm text-indigo-600 mt-2">
                            Revisa el estado de todas las cámaras y el historial de eventos recientes.
                        </p>
                        <a href="#" class="mt-4 inline-block text-indigo-500 hover:text-indigo-700 font-semibold text-sm">
                            Ir a Cámaras &rarr;
                        </a>
                    </div>

                    <!-- Tarjeta de Personal -->
                    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-5 shadow-md">
                        <div class="text-lg font-bold text-green-700">Reporte de Personal</div>
                        <p class="text-sm text-green-600 mt-2">
                            Visualiza el desempeño y los horarios del personal asignado.
                        </p>
                        <a href="#" class="mt-4 inline-block text-green-500 hover:text-green-700 font-semibold text-sm">
                            Ir a Personal &rarr;
                        </a>
                    </div>
                    
                    <!-- Tarjeta de Alertas -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-5 shadow-md">
                        <div class="text-lg font-bold text-yellow-700">Alertas Pendientes</div>
                        <p class="text-sm text-yellow-600 mt-2">
                            Gestiona y atiende las alertas de seguridad generadas por el sistema.
                        </p>
                        <a href="#" class="mt-4 inline-block text-yellow-500 hover:text-yellow-700 font-semibold text-sm">
                            Ver Alertas &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>