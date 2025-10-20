<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Camera;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Panel de control
    public function dashboard()
    {
        $users = User::all();
        $cameras = Camera::all();
        return view('admin.dashboard', compact('users', 'cameras'));
    }

    // Mostrar formulario para agregar personal
    public function showAddUser()
    {
        return view('users.add_user');
    }

    // Agregar usuario nuevo
    public function addUser(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|string|in:admin,user', // corregido
        ]);

        // Genera contraseña temporal aleatoria
        $tempPassword = Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($tempPassword),
            'is_temp_password' => true, // obligatorio cambio de contraseña
        ]);

        // Redirige mostrando la contraseña temporal
        return redirect()->route('users.add')
            ->with('success', "Usuario creado. Contraseña temporal: {$tempPassword}");
    }

    // Mostrar formulario para agregar cámara
    public function showAddCamera()
    {
        return view('cameras.add_camera');
    }

    // Agregar cámara
    public function addCamera(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip|unique:cameras,ip',
            'name' => 'nullable|string|max:255',
        ]);

        Camera::create([
            'ip' => $request->ip,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Cámara agregada.');
    }

    // Ver todas las cámaras
    public function viewCameras()
    {
        $cameras = Camera::all();
        return view('admin.view_cameras', compact('cameras'));
    }

    // Ver cámara individual
    public function viewCamera($id)
    {
        $camera = Camera::findOrFail($id);
        return view('admin.view_camera', compact('camera'));
    }
}
