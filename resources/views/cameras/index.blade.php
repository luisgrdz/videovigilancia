<h2 class="text-xl font-bold mb-4">Cámaras</h2>

@auth
    @if(auth()->user()->role_id == 1)
        <a href="{{ route('admin.cameras.create') }}" class="btn mb-4 bg-blue-600 text-white px-3 py-2 rounded">Agregar Cámara</a>
    @else
        <a href="{{ route('user.cameras.create') }}" class="btn mb-4 bg-blue-600 text-white px-3 py-2 rounded">Agregar Cámara</a>
    @endif
@endauth

<table class="table-auto w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border border-gray-300">Nombre</th>
            <th class="p-2 border border-gray-300">IP</th>
            <th class="p-2 border border-gray-300">Ubicación</th>
            <th class="p-2 border border-gray-300">Estado</th>
            <th class="p-2 border border-gray-300">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cameras as $camera)
        <tr class="border-b">
            <td class="p-2">{{ $camera->name }}</td>
            <td class="p-2">{{ $camera->ip }}</td>
            <td class="p-2">{{ $camera->location }}</td>
            <td class="p-2">
                <span class="{{ $camera->status ? 'text-green-600' : 'text-red-600' }}">
                    {{ $camera->status ? 'Activa' : 'Inactiva' }}
                </span>
            </td>
            <td class="p-2 flex gap-2">
                @if(auth()->user()->role_id == 1)
                    <a href="{{ route('admin.cameras.show', $camera) }}" class="btn-sm bg-gray-200 px-2 py-1 rounded">Ver</a>
                    <a href="{{ route('admin.cameras.edit', $camera) }}" class="btn-sm bg-yellow-200 px-2 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.cameras.destroy', $camera) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn-sm text-red-500 px-2 py-1 rounded">Eliminar</button>
                    </form>
                @else
                    <a href="{{ route('user.cameras.show', $camera) }}" class="btn-sm bg-gray-200 px-2 py-1 rounded">Ver</a>
                    <a href="{{ route('user.cameras.edit', $camera) }}" class="btn-sm bg-yellow-200 px-2 py-1 rounded">Editar</a>
                    <form action="{{ route('user.cameras.destroy', $camera) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn-sm text-red-500 px-2 py-1 rounded">Eliminar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $cameras->links() }}
</div>
