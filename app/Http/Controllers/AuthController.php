<?php

namespace App\Http\Controllers;

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

            // 1. Obtener el usuario autenticado
            $user = Auth::user();

            // 2. Verificar si el usuario está inactivo (status = false)
            if (!$user->status) {
                // 3. Desloguear al usuario inmediatamente
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // 4. Redirigir con mensaje de error
                return back()->withErrors([
                    // Mensaje de notificación solicitado por el usuario
                    'email' => 'Su cuenta está inactiva. Comuníquese con el administrador para solicitar acceso.',
                ])->onlyInput('email');
            }

            // Si el status es true, proceder con el inicio de sesión normal
            $request->session()->regenerate();

            // Redirigir según rol
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        // Si Auth::attempt() falla (credenciales incorrectas)
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
            'password' => 'required|min:6|confirmed',
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

