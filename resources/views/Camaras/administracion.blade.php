@extends('components.layouts.base')

@section('titulo', 'Ajustes de Administración')

@section('contenido')
    <h2>Ajustes de Administración del Sistema</h2>

    <h4>Gestión de Usuarios</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>admin</td>
                <td>Administrador</td>
                <td>Activo</td>
                <td>
                    <button class="btn btn-sm btn-primary">Editar</button>
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
            <tr>
                <td>operador1</td>
                <td>Operador</td>
                <td>Activo</td>
                <td>
                    <button class="btn btn-sm btn-primary">Editar</button>
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>

    <h4>Seguridad del Sistema</h4>
    <form>
        <div class="mb-3">
            <label for="passwordPolicy" class="form-label">Política de Contraseñas</label>
            <input type="text" id="passwordPolicy" class="form-control" placeholder="mínimo 8 caracteres, incluir números y letras">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="twoFactor">
            <label class="form-check-label" for="twoFactor">Activar autenticación de dos factores (2FA)</label>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
@endsection
