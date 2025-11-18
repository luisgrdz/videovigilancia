<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Camera;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Contar todos los usuarios
        $totalUsers = User::count();

        // 2. Contar todas las cámaras
        $totalCameras = Camera::count();

        // 3. Contar SOLO las cámaras activas (status = 1 o true)
        $activeCameras = Camera::where('status', true)->count();

        // 4. Retornar la vista con las 3 variables
        // Asegúrate que tu vista se llame 'admin.dashboard' o la ruta donde la tengas guardada
        return view('admin.dashboard', compact('totalUsers', 'totalCameras', 'activeCameras'));
    }
}