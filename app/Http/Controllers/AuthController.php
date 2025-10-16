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
        ]);

        $tempPassword = Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
            'is_temp_password' => true,
        ]);

        // Envía correo con la contraseña temporal
        Mail::send('auth.email_temp_password', ['password' => $tempPassword], function ($m) use ($user) {
            $m->to($user->email)->subject('Tu contraseña temporal');
        });

        return redirect()->route('login')->with('success', 'Registro exitoso. Revisa tu correo.');
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
                return redirect()->route('user.dashboard');
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
