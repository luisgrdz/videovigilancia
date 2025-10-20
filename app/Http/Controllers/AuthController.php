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

    // Mostrar registro
    public function showRegister()
    {
        return view('auth.register');
    }

    
    // Registrar nuevo usuario (para admins)
    public function addUser(Request $request)
    {
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

    // Iniciar sesión
    public function login(Request $request)
    {
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

    // Mostrar formulario de cambio de contraseña
    public function showChangePassword()
    {
        return view('auth.change_password');
    }

    // Cambiar contraseña
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->is_temp_password = false;
        $user->save();

        return redirect()->route(
            $user->role === 'admin' ? 'admin.dashboard' : 'users.dashboard'
        )->with('success', 'Contraseña actualizada correctamente.');
    }


    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    
}
