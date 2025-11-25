<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// La siguiente línea ha sido eliminada porque el middleware se aplica por alias:
// use App\Http\Middleware\CheckRole; 

class SupervisorController extends Controller
{
    /**
     * Aplica el middleware 'checkRole:3' para restringir el acceso solo a Supervisores.
     * El role_id = 3 corresponde al rol 'Supervisor'.
     */
   
    /**
     * Muestra el dashboard específico del Supervisor.
     * En este dashboard, el Supervisor podría ver el estado general de las cámaras 
     * y quizás la actividad del personal bajo su supervisión.
     */
    public function dashboard()
    {
        // Lógica para el dashboard del supervisor:
        // Por ejemplo:
        // $camaras_activas = \App\Models\Camera::where('status', true)->count();
        // $personal_total = \App\Models\Personal::count();

        return view('supervisor.dashboard', [
            'supervisor' => Auth::user(),
            // 'camaras_activas' => $camaras_activas,
            // 'personal_total' => $personal_total,
        ]);
    }

    // Aquí puedes añadir más métodos para la gestión de cámaras o personal,
    // si el Supervisor tiene permisos para ello.
}
