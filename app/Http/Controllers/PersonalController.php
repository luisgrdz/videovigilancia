<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    // Mostrar lista de usuarios
    public function index()
    {
        $users = User::all();
        return view('admin.personal.index', compact('users'));
    }

    // Mostrar formulario para crear nuevo usuario
    public function create()
    {
        return view('admin.personal.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'status' => true, // activo por defecto
        ]);

        return redirect()->route('admin.personal')->with('success', 'Usuario creado correctamente');
    }

    // Mostrar formulario para editar usuario
    public function edit(User $user)
    {
        return view('admin.personal.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.personal')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.personal')->with('success', 'Usuario eliminado correctamente');
    }

    // Bloquear/Desbloquear usuario
    public function toggle(User $user)
    {
        $user->status = !$user->status;
        $user->save();
        $mensaje = $user->status ? 'Usuario activado' : 'Usuario bloqueado';
        return redirect()->route('admin.personal')->with('success', $mensaje);
    }
}
