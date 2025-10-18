<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role !== 'user') {
            abort(403, 'Acceso no autorizado');
        }

        return view('users/dashboard');
    }
}
