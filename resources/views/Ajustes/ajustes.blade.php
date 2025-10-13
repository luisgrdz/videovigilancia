@extends('components.layouts.base')

@section('titulo', 'Ajustes del Sistema')

@section('contenido')
    <h2>Ajustes del Sistema de Videovigilancia</h2>

    <form>
        <h4>Configuración de Cámaras</h4>
        <div class="mb-3">
            <label for="cameraName" class="form-label">Nombre de la Cámara</label>
            <input type="text" id="cameraName" class="form-control" placeholder="Cámara 1">
        </div>
        <div class="mb-3">
            <label for="cameraURL" class="form-label">URL del Stream</label>
            <input type="text" id="cameraURL" class="form-control" placeholder="http://192.168.1.101/stream">
        </div>
        <div class="mb-3">
            <label for="cameraResolution" class="form-label">Resolución</label>
            <select id="cameraResolution" class="form-select">
                <option value="UXGA">UXGA (1600x1200)</option>
                <option value="SVGA">SVGA (800x600)</option>
                <option value="VGA">VGA (640x480)</option>
                <option value="QVGA">QVGA (320x240)</option>
            </select>
        </div>

        <h4>Notificaciones</h4>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="motionAlert">
            <label class="form-check-label" for="motionAlert">Activar alertas por detección de movimiento</label>
        </div>

        <h4>Almacenamiento</h4>
        <div class="mb-3">
            <label for="storageOption" class="form-label">Tipo de almacenamiento</label>
            <select id="storageOption" class="form-select">
                <option value="SD">Tarjeta SD local</option>
                <option value="Server">Servidor central</option>
                <option value="Cloud">Nube</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Ajustes</button>
    </form>
@endsection
