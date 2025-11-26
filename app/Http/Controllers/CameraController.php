<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importante para usar authorize

class CameraController extends Controller
{
    use AuthorizesRequests; // Activa los permisos en este controlador

    public function index(Request $request)
    {
        // Todos pueden ver (según definimos en el Gate), pero filtramos qué ven
        $this->authorize('ver_camaras');

        $query = Camera::query();
        
        // Si no es Admin ni Supervisor, solo ve las cámaras activas (por ejemplo)
        $userRole = Auth::user()->role->name;
        if (!in_array($userRole, ['admin', 'supervisor'])) {
            $query->where('status', true);
        }

        $cameras = $query->paginate(12);
        return view('cameras.index', compact('cameras'));
    }

    public function create()
    {
        $this->authorize('crear_camaras'); // Bloqueo de seguridad
        return view('cameras.create');
    }

    public function store(Request $request)
    {
        $this->authorize('crear_camaras');

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|string',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean',
            'group'    => 'nullable|string|max:255',
        ]);

        Camera::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route($this->getRedirectRoute())->with('success', 'Cámara registrada.');
    }

    public function show(Camera $camera)
    {
        $this->authorize('ver_camaras');
        return view('cameras.show', compact('camera'));
    }

    public function edit(Camera $camera)
    {
        $this->authorize('editar_camaras'); // Solo Admin, Supervisor, Mantenimiento
        return view('cameras.edit', compact('camera'));
    }

    public function update(Request $request, Camera $camera)
    {
        $this->authorize('editar_camaras');

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|string',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean',
            'group'    => 'nullable|string|max:255',
        ]);

        $camera->update($validated);

        return redirect()->route($this->getRedirectRoute())->with('success', 'Cámara actualizada.');
    }

    public function destroy(Camera $camera)
    {
        $this->authorize('borrar_camaras'); // SOLO ADMIN
        $camera->delete();

        return redirect()->route($this->getRedirectRoute())->with('success', 'Cámara eliminada.');
    }

    // Helper para saber a dónde volver según el rol
    private function getRedirectRoute()
    {
        $role = Auth::user()->role->name;
        // Ajusta estos prefijos según tus rutas web.php
        return match ($role) {
            'admin' => 'admin.cameras.index',
            'supervisor' => 'supervisor.cameras.index',
            'mantenimiento' => 'mantenimiento.cameras.index',
            default => 'user.cameras.index',
        };
    }
}