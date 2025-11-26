<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CameraController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $roleName = $user->role->name ?? 'user';
        $query = Camera::with('user');

        // 1. ADMIN y MANTENIMIENTO: Ven TODAS las cámaras
        if ($roleName === 'admin' || $roleName === 'mantenimiento') {
            // No aplicamos filtro
        }
        // 2. SUPERVISOR: Ve las suyas + las de sus subordinados
        elseif ($roleName === 'supervisor') {
            $subordinateIds = $user->subordinates()->pluck('id');
            $query->where(function ($q) use ($user, $subordinateIds) {
                $q->where('user_id', $user->id)
                    ->orWhereIn('user_id', $subordinateIds);
            });
        }
        // 3. USUARIO: Solo ve las suyas
        else {
            $query->where('user_id', $user->id);
        }

        $cameras = $query->paginate(12);
        return view('cameras.index', compact('cameras'));
    }

    public function create()
    {
        // Admin y Mantenimiento pueden asignar dueño
        $userRole = Auth::user()->role->name;
        $users = ($userRole === 'admin' || $userRole === 'mantenimiento') ? User::all() : [];

        return view('cameras.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // CAMBIO CRÍTICO: 'string' para aceptar YouTube y URLs largas
            'ip' => 'required|string',
            'location' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'group' => 'nullable|string|max:255',
        ]);

        Camera::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        $prefix = $request->is('admin*') ? 'admin.' : 'user.';
        return redirect()->route($prefix . 'cameras.index')->with('success', 'Cámara registrada correctamente.');
    }
    public function show(Camera $camera)
    {
        return view('cameras.show', compact('camera'));
    }

    public function edit(Camera $camera)
    {
        $userRole = Auth::user()->role->name;

        // Admin y Mantenimiento pueden reasignar dueño
        $users = ($userRole === 'admin' || $userRole === 'mantenimiento') ? User::all() : [];

        return view('cameras.edit', compact('camera', 'users'));
    }

    public function update(Request $request, Camera $camera)
    {
        $currentUser = Auth::user();

        if ($currentUser->role?->name !== 'admin' && $camera->user_id !== $currentUser->id) {
            abort(403, 'No tienes permiso para modificar esta cámara.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // CAMBIO CRÍTICO: Ahora Update también acepta 'string'
            'ip' => 'required|string',
            'location' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'group' => 'nullable|string|max:255',
        ]);

        $camera->update($validated);

        $prefix = $request->is('admin*') ? 'admin.' : 'user.';
        return redirect()->route($prefix . 'cameras.index')->with('success', 'Cámara actualizada correctamente.');
    }

    public function destroy(Camera $camera)
    {
        $camera->delete();
        return redirect()->back()->with('success', 'Eliminada');
    }
}
