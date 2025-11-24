<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login'); // O la ruta de login de su aplicación
        }

        $user = Auth::user();

        // 2. Comprobar si el role_id del usuario está en la lista de roles permitidos
        // NOTA: Los $roles son los argumentos que se pasan desde la ruta, ej: 'admin'
        // Asumiendo que el Role ID 1 es 'admin', y 2 es 'user' (por su migración)

        // Mapeo simple de roles a IDs (Role ID 1 = Admin)
        $roleMapping = [
            'admin' => 1,
            'user'  => 2,
        ];

        foreach ($roles as $role) {
            $roleId = $roleMapping[$role] ?? null;

            if ($roleId && $user->role_id == $roleId) {
                // Si el usuario tiene el rol requerido, permitir acceso
                return $next($request);
            }
        }

        // Si no tiene el rol, redirigir o abortar
        return abort(403, 'Acceso no autorizado: No tiene permiso para acceder a esta sección.');
    }
}
