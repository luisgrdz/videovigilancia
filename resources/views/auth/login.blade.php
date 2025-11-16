<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al sistema</title>

    <!-- Bootstrap LOCAL -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <!-- Fuente moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #dce6ff, #f7f9ff, #e3ddff);
            padding: 20px;
        }

        /* Tarjeta moderna */
        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 40px 35px;
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0px 8px 35px rgba(0, 0, 0, 0.12);
            animation: fadeIn .7s ease-out;
        }

        /* Título con degradado suave */
        .title-gradient {
            background: linear-gradient(90deg, #6a5af9, #7a9cff);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Inputs estilo suave */
        .form-control {
            border-radius: 12px;
            padding: 10px 14px;
            background: #f5f7ff;
            border: 1px solid #d5d9e6;
            transition: .2s;
        }

        .form-control:focus {
            border-color: #7a9cff;
            box-shadow: 0 0 0 3px rgba(122, 156, 255, .3);
        }

        /* Botón degradado claro */
        .btn-gradient {
            background: linear-gradient(135deg, #6a5af9, #7a9cff);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            padding: 12px;
            transition: .2s;
        }

        .btn-gradient:hover {
            transform: scale(1.02);
            box-shadow: 0px 6px 15px rgba(122, 156, 255, .4);
        }

        /* Animación */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

    <div class="login-card">

        <h2 class="text-center mb-4 title-gradient fw-bold display-6">
            Iniciar sesión
        </h2>

        @if($errors->any())
            <div class="alert alert-danger py-2 small text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Correo electrónico</label>
                <input type="email" name="email" class="form-control"
                       placeholder="correo@ejemplo.com" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Contraseña</label>
                <input type="password" name="password" class="form-control"
                       placeholder="••••••••" required>
            </div>

            <!-- Botón -->
            <button class="btn btn-gradient w-100 mt-2">
                Acceder
            </button>
        </form>

        <p class="text-center text-secondary mt-4 small">
            Sistema de Videovigilancia • {{ date('Y') }}
        </p>
    </div>

    <!-- Bootstrap JS LOCAL -->
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
