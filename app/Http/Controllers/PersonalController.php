<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    public function index()
    {
        // Cargamos 'role' y 'supervisor' para optimizar la consulta y mostrar el encargado
        $users = User::with(['role', 'supervisor'])->where('role_id', '!=', 1)->paginate(10);
        return view('personal.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'admin')->get();

        $supervisors = User::whereHas('role', function ($q) {
            $q->where('name', 'supervisor');
        })->get();

        return view('personal.create', compact('roles', 'supervisors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id'  => 'required|exists:roles,id',
            'supervisor_id' => 'nullable|exists:users,id'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role_id'  => $request->role_id,
            'supervisor_id' => $request->supervisor_id,
            'status'   => 1,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.personal.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'admin')->get();

        $supervisors = User::whereHas('role', function ($q) {
            $q->where('name', 'supervisor');
        })
            ->where('id', '!=', $user->id)
            ->get();

        return view('personal.edit', compact('user', 'roles', 'supervisors'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => "required|email|unique:users,email,$user->id",
            'role_id' => 'required|exists:roles,id',
            'supervisor_id' => 'nullable|exists:users,id'
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'supervisor_id' => $request->supervisor_id
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.personal.index')
            ->with('success', 'Usuario actualizado.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.personal.index')
            ->with('success', 'Usuario eliminado.');
    }

    public function toggle(User $user)
    {
        $user->update([
            'status' => !$user->status
        ]);

        return redirect()->route('admin.personal.index')
            ->with('success', 'Estado del usuario actualizado.');
    }
}
