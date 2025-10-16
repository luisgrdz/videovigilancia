<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Videovigilancia - Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Estilo general del cuerpo */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e4e9f0, #f5f6fa);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar personalizado */
        .navbar-custom {
            background-color: #1b1f38;
            padding: 1rem 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .navbar-custom .navbar-brand {
            color: #ffffff;
            font-weight: bold;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }

        .navbar-custom .nav-link {
            color: #cfd3e0;
            margin-left: 1rem;
            transition: color 0.3s;
        }

        .navbar-custom .nav-link:hover {
            color: #ffffff;
        }

        /* Contenedor principal */
        .content {
            flex: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
        }

        .content h2 {
            color: #1b1f38;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .content p {
            color: #4a4e69;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        /* Tarjetas informativas */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.25);
        }

        .card-header {
            background: linear-gradient(90deg, #1b1f38, #2e3250);
            color: #ffffff;
            font-weight: 600;
            font-size: 1.1rem;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            padding: 20px;
            color: #333;
            font-size: 0.95rem;
        }

        /* Efecto responsive en tarjetas */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Videovigilancia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="#">Reportar Algo</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="content container">
        <h2>Bienvenido al Sistema de Videovigilancia</h2>
        <p>Aquí puedes encontrar información útil, consejos y alertas para realizar tus labores de monitoreo de manera eficiente y segura.</p>

        <!-- Tarjetas de información -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Consejo de Seguridad</div>
                    <div class="card-body">
                        <p>Verifica periódicamente las cámaras críticas para asegurarte de que no haya fallos o áreas sin cobertura.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Alerta Importante</div>
                    <div class="card-body">
                        <p>Si se detecta movimiento fuera del horario establecido, notifica inmediatamente al supervisor de turno.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Recordatorio Diario</div>
                    <div class="card-body">
                        <p>Mantén los accesos principales desbloqueados únicamente para el personal autorizado y revisa los sensores de seguridad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
