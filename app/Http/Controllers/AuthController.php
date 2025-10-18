<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Vista de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Vista de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Registro nuevo usuario
    public function register(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // valida confirmación
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // o admin según necesidad
            'is_temp_password' => false, // ya tiene contraseña definida
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente.');
    }


    // Iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('users.dashboard');
            }
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

}
