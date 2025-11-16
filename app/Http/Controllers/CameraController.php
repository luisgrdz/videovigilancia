<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camera;

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
        $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|ip',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|in:active,inactive'
        ]);

        Camera::create($request->all());

        return redirect()->route('cameras.index')
            ->with('success', 'Cámara registrada.');
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
        $request->validate([
            'name'     => 'required|string|max:255',
            'ip'       => 'required|ip',
            'location' => 'nullable|string|max:255',
            'status'   => 'required|in:active,inactive'
        ]);

        $camera->update($request->all());

        return redirect()->route('cameras.index')
            ->with('success', 'Cámara actualizada.');
    }

    public function destroy(Camera $camera)
    {
        $camera->delete();

        return redirect()->route('cameras.index')
            ->with('success', 'Cámara eliminada.');
    }
}
