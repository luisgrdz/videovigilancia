<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CameraController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        // Verificamos permiso general
        $this->authorize('ver_camaras');

        $query = Camera::query();
        $userRole = Auth::user()->role->name;
        
        // --- CORRECCIÓN AQUÍ ---
        // Antes: if (!in_array($userRole, ['admin', 'supervisor']))
        // Ahora: Agregamos 'mantenimiento' para que ellos también vean las cámaras apagadas
        if (!in_array($userRole, ['admin', 'supervisor', 'mantenimiento'])) {
            // Si es un usuario normal (Guardia), SOLO ve las activas
            $query->where('status', true);
        }

        $cameras = $query->paginate(12);
        return view('cameras.index', compact('cameras'));
    }

    public function create()
    {
        $this->authorize('crear_camaras');
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

        return redirect()->route($this->getRedirectRoute())->with('success', 'Cámara registrada correctamente.');
    }

    public function show(Camera $camera)
    {
        $this->authorize('ver_camaras');
        return view('cameras.show', compact('camera'));
    }

    public function edit(Camera $camera)
    {
        $this->authorize('editar_camaras');
        return view('cameras.edit', compact('camera'));
    }

    public function update(Request $request, Camera $camera)
    {
        $this->authorize('editar_camaras');

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|string',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean', // Aquí es donde Mantenimiento reactiva la cámara
            'group'    => 'nullable|string|max:255',
        ]);

        $camera->update($validated);

        return redirect()->route($this->getRedirectRoute())->with('success', 'Cámara actualizada correctamente.');
    }

    public function destroy(Camera $camera)
    {
        $this->authorize('borrar_camaras');
        $camera->delete();

        return redirect()->route($this->getRedirectRoute())->with('success', 'Cámara eliminada del sistema.');
    }

    // Función auxiliar para redirigir al usuario a su panel correcto
    private function getRedirectRoute()
    {
        $role = Auth::user()->role->name;
        return match ($role) {
            'admin' => 'admin.cameras.index',
            'supervisor' => 'supervisor.cameras.index',
            'mantenimiento' => 'mantenimiento.cameras.index',
            default => 'user.cameras.index',
        };
    }

    public function multiview()
    {
        // Verificamos que tenga permiso general de ver cámaras
        $this->authorize('ver_camaras');

        // Obtenemos SOLO las cámaras activas para el monitor
        $cameras = Camera::where('status', true)
                        ->orderBy('name')
                        ->get();

        return view('cameras.multiview', compact('cameras'));
    }
}