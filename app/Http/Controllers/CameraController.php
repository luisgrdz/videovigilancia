<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Usar Auth para claridad

class CameraController extends Controller
{
    public function index(Request $request)
    {
        $query = Camera::query();

        // 1. Lógica de Filtrado por Rol
        $currentUser = Auth::user(); // Obtener el usuario autenticado

        // Usamos el operador null-safe (?->) para acceder a role->name.
        // Si el rol es nulo, se evalúa a nulo y la comparación falla, lo cual es seguro.
        if ($currentUser && $currentUser->role?->name !== 'admin') {
            // Si NO es administrador o si el rol no está definido, solo muestra sus propias cámaras
            $query->where('user_id', $currentUser->id);
        }

        // 2. Aplicar Paginación
        $cameras = $query->paginate(12);

        return view('cameras.index', compact('cameras'));
    }

    public function create()
    {
        return view('cameras.create');
    }

public function store(Request $request)
{
    // 1. Validación (CAMBIAMOS 'ip' => 'required|ip' POR 'required|string')
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'ip'       => 'required|string', // <--- CAMBIO AQUÍ: Ahora acepta URLs completas
        'location' => 'nullable|string|max:255',
        'status'   => 'required|boolean',
        'group'    => 'nullable|string|max:255',
    ]);

    // 2. Crear y asignar el ID del usuario actual
    Camera::create([
        ...$validated,
        'user_id' => Auth::id(),
    ]);

    // 3. Redirección Inteligente
    $prefix = $request->is('admin*') ? 'admin.' : 'user.';

    return redirect()->route($prefix . 'cameras.index')
        ->with('success', 'Cámara registrada correctamente.');
}

    public function show(Camera $camera)
    {
        // Nota: Deberías agregar aquí la verificación de propiedad para usuarios no admin.
        return view('cameras.show', compact('camera'));
    }

    public function edit(Camera $camera)
    {
        // Nota: Deberías agregar aquí la verificación de propiedad para usuarios no admin.
        return view('cameras.edit', compact('camera'));
    }

    public function update(Request $request, Camera $camera)
    {
        $currentUser = Auth::user();

        // ** 1. Control de Propietario CORREGIDO (Uso del operador null-safe) **
        if ($currentUser->role?->name !== 'admin' && $camera->user_id !== $currentUser->id) {
            abort(403, 'No tienes permiso para modificar esta cámara.');
        }

        // 2. Validación COMPLETA (Ahora incluye 'group')
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|ip',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|boolean',
            'group'    => 'nullable|string|max:255', // Campo 'group' añadido
        ]);

        // 3. Actualizar
        $camera->update($validated);

        // 4. Redirección Inteligente
        $prefix = $request->is('admin*') ? 'admin.' : 'user.';

        return redirect()->route($prefix . 'cameras.index')
            ->with('success', 'Cámara actualizada correctamente.');
    }

    public function destroy(Request $request, Camera $camera)
    {
        // Nota: Deberías agregar aquí la verificación de propiedad para usuarios no admin.
        $camera->delete();

        // Redirección Inteligente
        $prefix = $request->is('admin*') ? 'admin.' : 'user.';

        return redirect()->route($prefix . 'cameras.index')
            ->with('success', 'Cámara eliminada correctamente.');
    }
}
