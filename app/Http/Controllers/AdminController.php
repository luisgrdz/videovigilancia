<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Camera;

class AdminController extends Controller
{
    // Panel de control
    public function dashboard()
    {
        $users = User::all();
        $cameras = Camera::all();
        return view('admin.dashboard', compact('users', 'cameras'));
    }

    // Agregar nuevo personal
    public function showAddUser()
    {
        return view('users.add_user');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:admin,personal',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('temporal123'), // contraseña temporal
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Personal agregado.');
    }

    // Agregar nueva cámara
    public function showAddCamera()
    {
        return view('cameras.add_camera');
    }

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

    public function viewCameras()
    {
        $cameras = Camera::all();
        return view('admin.view_camaras', compact('cameras'));
    }

    public function viewCamera($id)
    {
        $camera = Camera::findOrFail($id);
        return view('admin.view_camera', compact('camera'));
    }
}

