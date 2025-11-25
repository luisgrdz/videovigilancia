<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // 1. Verificar estatus
            if (!$user->status) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Su cuenta está inactiva. Comuníquese con el administrador.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            // 2. REDIRECCIÓN POR ROL (Aquí estaba el error lógico)
            // Usamos switch para manejar los 3 casos definidos en tus rutas
            switch ($user->role_id) {
                case 1: // Admin
                    return redirect()->intended(route('admin.dashboard'));

                case 3: // Supervisor (Rol ID 3 según tu Seeder)
                    return redirect()->intended(route('supervisor.dashboard'));

                case 2: // User
                default:
                    return redirect()->intended(route('user.dashboard'));
            }
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    // Si vas a usar después cambio de contraseña:
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                // Aumenta el mínimo a 12
                Password::min(12)
                    // Requiere al menos una letra mayúscula
                    ->mixedCase()
                    // Requiere al menos un número
                    ->numbers()
                    // Requiere al menos un símbolo (carácter especial)
                    ->symbols(),
            ],
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Contraseña actualizada correctamente');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
}

