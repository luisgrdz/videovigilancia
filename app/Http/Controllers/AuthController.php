<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Mostrar login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Iniciar sesión
    public function login(Request $request)
    {


        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Si tiene contraseña temporal, obliga a cambiarla
            if ($user->is_temp_password) {
                return redirect()->route('password.change.form');
            }

            // Redirige según rol
            return $user->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('users.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }


    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Mostrar formulario de cambio de contraseña (solo para usuarios con contraseña temporal)
    public function showChangePassword()
    {
        $user = Auth::user();

        if (!$user || !$user->is_temp_password) {
            return redirect()->route(
                $user->role === 'admin' ? 'admin.dashboard' : 'users.dashboard'
            );
        }

        return view('auth.change_password');
    }

    // Cambiar contraseña (solo usuarios con contraseña temporal)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!$user || !$user->is_temp_password) {
            return redirect()->route(
                $user->role === 'admin' ? 'admin.dashboard' : 'users.dashboard'
            );
        }

        $user->password = Hash::make($request->password);
        $user->is_temp_password = false;
        $user->save();

        return redirect()->route(
            $user->role === 'admin' ? 'admin.dashboard' : 'users.dashboard'
        )->with('success', 'Contraseña actualizada correctamente.');
    }

    // Crear usuario (solo admin)
    public function addUser(Request $request)
    {
        $admin = Auth::user();

        if (!$admin || $admin->role !== 'admin') {
            abort(403, 'No autorizado');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|string|in:admin,user', // solo admin o user
        ]);

        // Genera contraseña temporal
        $tempPassword = Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($tempPassword),
            'is_temp_password' => true,
        ]);

        // Opcional: enviar correo con la contraseña temporal
        // Mail::to($user->email)->send(new TempPasswordMail($tempPassword));

        return redirect()->route('users.add')
            ->with('success', "Usuario creado. Contraseña temporal: {$tempPassword}");
    }

    // Mostrar formulario para admins crear usuarios
    public function showAddUser()
    {
        $admin = Auth::user();

        if (!$admin || $admin->role !== 'admin') {
            abort(403, 'No autorizado');
        }

        return view('admin.add_user'); // crea esta vista
    }
}
