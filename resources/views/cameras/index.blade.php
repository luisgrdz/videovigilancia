<h2 class="text-xl font-bold mb-4">Cámaras</h2>

<a href="{{ route('cameras.create') }}" class="btn mb-4">Agregar Cámara</a>

<table class="table-auto w-full">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>IP</th>
            <th>Ubicación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cameras as $camera)
        <tr>
            <td>{{ $camera->name }}</td>
            <td>{{ $camera->ip }}</td>
            <td>{{ $camera->location }}</td>
            <td>{{ $camera->status ? 'Activa' : 'Inactiva' }}</td>
            <td>
                <a href="{{ route('cameras.show', $camera) }}" class="btn-sm">Ver</a>
                <a href="{{ route('cameras.edit', $camera) }}" class="btn-sm">Editar</a>
                <form action="{{ route('cameras.destroy', $camera) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn-sm text-red-500">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
