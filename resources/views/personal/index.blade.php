@extends('components.layouts.app')

@section('titulo','Gestión de personal')

@section('contenido')

<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Personal</h1>
    <a href="{{ route('admin.personal.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Añadir usuario</a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">Nombre</th>
            <th class="p-3">Email</th>
            <th class="p-3">Estado</th>
            <th class="p-3">Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $user)
        <tr class="border-b">
            <td class="p-3">{{ $user->name }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td>
                @if($user->status)
                    <span class="text-green-600 font-semibold">Activo</span>
                @else
                    <span class="text-red-600 font-semibold">Inactivo</span>
                @endif
            </td>

            <td class="p-3 flex gap-2">
                <a href="{{ route('admin.personal.edit', $user) }}" class="text-blue-600">Editar</a>

                <form action="{{ route('admin.personal.toggle', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="px-3 py-1 rounded {{ $user->status ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                        {{ $user->status ? 'Desactivar' : 'Activar' }}
                    </button>
                </form>

                <form action="{{ route('admin.personal.destroy', $user) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>

@endsection
