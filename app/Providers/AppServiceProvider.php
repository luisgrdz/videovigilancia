<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // --- 1. PERMISOS DE CÁMARAS ---

        // ¿Quién puede ver el listado y detalles? (Todos)
        Gate::define('ver_camaras', function (User $user) {
            return true; 
        });

        // ¿Quién puede crear cámaras nuevas? (Solo Admin y Supervisor)
        Gate::define('crear_camaras', function (User $user) {
            return in_array($user->role->name, ['admin', 'supervisor']);
        });

        // ¿Quién puede editar configuración? (Admin, Supervisor y Mantenimiento)
        Gate::define('editar_camaras', function (User $user) {
            return in_array($user->role->name, ['admin', 'supervisor', 'mantenimiento']);
        });

        // ¿Quién puede eliminar? (SOLO Admin - Es peligroso)
        Gate::define('borrar_camaras', function (User $user) {
            return $user->role->name === 'admin';
        });


        // --- 2. PERMISOS DE PERSONAL (Usuarios) ---

        // Solo el Admin puede tocar usuarios
        Gate::define('gestionar_personal', function (User $user) {
            return $user->role->name === 'admin';
        });


        // --- 3. PERMISOS DE PANELES (Dashboards) ---

        Gate::define('ver_dashboard_global', function (User $user) {
            return in_array($user->role->name, ['admin', 'supervisor']);
        });

        Gate::define('ver_dashboard_tecnico', function (User $user) {
            return $user->role->name === 'mantenimiento';
        });
    }
}