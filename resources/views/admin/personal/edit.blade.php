@extends('components.layouts.base')

@section('titulo', 'Editar Usuario')

@section('contenido')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow p-6">
    <h2 class="text-2xl font-bold mb-4">Editar Usuario</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-gray-700 font-medium">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2 mt-1" required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2 mt-1" required>
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Rol</label>
            <select name="role" class="w-full border rounded px-3 py-2 mt-1" required>
                <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>Administrador</option>
                <option value="user" {{ old('role', $user->role)=='user' ? 'selected' : '' }}>Usuario</option>
            </select>
            @error('role') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2 mt-1">
            @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2 mt-1">
        </div>

        <div class="flex justify-end gap-3 mt-4">
            <a href="{{ route('admin.personal') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded text-gray-700">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">Actualizar Usuario</button>
        </div>
    </form>
</div>
@endsection
