<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Camera::paginate(12);
        return view('cameras.index', compact('cameras'));
    }

    public function create()
    {
        return view('cameras.create');
    }

    public function store(Request $request)
    {
        // 1. Validación
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|ip',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean', // Espera 1 o 0
        ]);

        // 2. Crear
        Camera::create($validated);

        // 3. Redirección Inteligente
        // Detectamos prefijo para redirigir al index correcto
        $prefix = $request->is('admin*') ? 'admin.' : 'user.';

        return redirect()->route($prefix . 'cameras.index')
            ->with('success', 'Cámara registrada correctamente.');
    }

    public function show(Camera $camera)
    {
        return view('cameras.show', compact('camera'));
    }

    public function edit(Camera $camera)
    {
        return view('cameras.edit', compact('camera'));
    }

    public function update(Request $request, Camera $camera)
    {
        // 1. Validación
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|ip',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean', // Espera 1 o 0
        ]);

        // 2. Actualizar
        $camera->update($validated);

        // 3. Redirección Inteligente
        $prefix = $request->is('admin*') ? 'admin.' : 'user.';

        return redirect()->route($prefix . 'cameras.index')
            ->with('success', 'Cámara actualizada correctamente.');
    }

    public function destroy(Request $request, Camera $camera)
    {
        $camera->delete();

        // Redirección Inteligente
        $prefix = $request->is('admin*') ? 'admin.' : 'user.';

        return redirect()->route($prefix . 'cameras.index')
            ->with('success', 'Cámara eliminada correctamente.');
    }
}
