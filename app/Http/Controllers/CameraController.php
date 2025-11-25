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
            'name'     => 'required|string|max:255',
            'ip'       => 'required|string',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean',
            'group'    => 'nullable|string|max:255',
            'user_id'  => 'nullable|exists:users,id'
        ]);

        $userRole = Auth::user()->role->name;
        $ownerId = Auth::id();

        // Si es Admin o Mantenimiento y seleccionó un usuario, asignamos ese dueño
        if (($userRole === 'admin' || $userRole === 'mantenimiento') && !empty($request->user_id)) {
            $ownerId = $request->user_id;
        }

        Camera::create([
            ...$validated,
            'user_id' => $ownerId,
        ]);

        // Redirección dinámica
        $prefix = match ($userRole) {
            'admin' => 'admin.',
            'supervisor' => 'supervisor.',
            'mantenimiento' => 'mantenimiento.',
            default => 'user.',
        };

        return redirect()->route($prefix . 'cameras.index')
            ->with('success', 'Cámara registrada correctamente.');
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
        $user = Auth::user();
        $userRole = $user->role->name;

        // Permisos para editar
        if ($userRole !== 'admin' && $userRole !== 'mantenimiento' && $camera->user_id !== $user->id) {
            abort(403, 'No autorizado');
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|string',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean',
            'group'    => 'nullable|string|max:255',
            'user_id'  => 'nullable|exists:users,id'
        ]);

        // Solo Admin y Mantenimiento pueden cambiar el dueño
        if ($userRole !== 'admin' && $userRole !== 'mantenimiento') {
            unset($validated['user_id']);
        }

        $camera->update($validated);

        $prefix = match ($userRole) {
            'admin' => 'admin.',
            'supervisor' => 'supervisor.',
            'mantenimiento' => 'mantenimiento.',
            default => 'user.',
        };

        return redirect()->route($prefix . 'cameras.index')->with('success', 'Cámara actualizada.');
    }

    public function destroy(Camera $camera)
    {
        $camera->delete();
        return redirect()->back()->with('success', 'Eliminada');
    }
}
