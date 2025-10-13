<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Mi App Laravel')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1f2937;
            --accent-color: #10b981;
            --text-light: #f9fafb;
            --text-dark: #1f2937;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --transition-smooth: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e7ec 100%);
            color: var(--text-dark);
        }

        /* Sidebar mejorado con gradientes y animaciones */
        #sidebar {
            width: 70px;
            background: linear-gradient(180deg, var(--secondary-color) 0%, #111827 100%);
            color: var(--text-light);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: var(--transition-smooth);
            overflow: hidden;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        #sidebar.expanded {
            width: 240px;
        }

        #sidebar .logo-container {
            padding: 20px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
        }

        #sidebar .logo-icon {
            font-size: 24px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: transform 0.5s ease;
        }

        #sidebar.expanded .logo-icon {
            transform: rotate(360deg);
        }

        #sidebar .logo-text {
            font-weight: 700;
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            white-space: nowrap;
        }

        #sidebar .nav-link {
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 15px;
            white-space: nowrap;
            transition: var(--transition-smooth);
            margin: 5px 10px;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        #sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.7s;
        }

        #sidebar .nav-link:hover::before {
            left: 100%;
        }

        #sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        #sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        #sidebar .nav-icon {
            width: 24px;
            text-align: center;
            font-size: 18px;
            transition: var(--transition-smooth);
            z-index: 1;
        }

        #sidebar .nav-link:hover .nav-icon {
            transform: scale(1.2);
        }

        #sidebar .link-text {
            font-weight: 500;
            transition: var(--transition-smooth);
            z-index: 1;
        }

        #sidebar.collapsed .link-text {
            opacity: 0;
            transform: translateX(-10px);
        }

        #sidebar.expanded .link-text {
            opacity: 1;
            transform: translateX(0);
        }

        /* Contenido principal mejorado */
        #content {
            margin-left: 70px;
            padding: 25px;
            transition: var(--transition-smooth);
            flex: 1;
        }

        #sidebar.expanded ~ #content {
            margin-left: 240px;
        }

        /* Header del contenido */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .content-header h1 {
            font-weight: 700;
            color: var(--secondary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .content-header h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: var(--transition-smooth);
        }

        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Cards mejoradas */
        .card {
            box-shadow: var(--card-shadow);
            border: none;
            border-radius: 16px;
            transition: var(--transition-smooth);
            overflow: hidden;
            background: white;
            margin-bottom: 25px;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            font-weight: 600;
            padding: 15px 20px;
            border-bottom: none;
        }

        .card-body {
            padding: 25px;
        }

        /* Footer mejorado */
        footer {
            background: var(--secondary-color);
            color: var(--text-light);
            text-align: center;
            padding: 20px;
            margin-left: 70px;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        #sidebar.expanded ~ footer {
            margin-left: 240px;
        }

        /* Tablas mejoradas */
        .table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.05);
        }

        .table tbody tr {
            transition: var(--transition-smooth);
        }

        .table tbody tr:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transform: translateX(5px);
        }

        /* Badges y estados */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.15);
            color: var(--accent-color);
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        /* Botones mejorados */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: var(--transition-smooth);
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4);
        }

        /* Responsividad */
        @media (max-width: 768px) {
            #sidebar {
                width: 0;
            }
            
            #sidebar.expanded {
                width: 240px;
            }
            
            #content, footer {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1100;
                background: var(--primary-color);
                color: white;
                border: none;
                border-radius: 8px;
                width: 45px;
                height: 45px;
                font-size: 20px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* Animaciones adicionales */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        /* Efecto de partículas en el sidebar */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            opacity: 0;
        }
    </style>
</head>
<body>

    <!-- Botón de menú móvil -->
    <button class="mobile-menu-btn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar mejorado -->
    <div id="sidebar" class="d-flex flex-column p-2 collapsed">
        <div class="particles" id="particles-container"></div>
        <div class="logo-container">
            <div class="logo-icon">
                <i class="fas fa-video"></i>
            </div>
            <div class="logo-text">VideoVigilancia</div>
        </div>
        <nav class="nav flex-column">
            <a href="/" class="nav-link active">
                <span class="nav-icon"><i class="fas fa-home"></i></span>
                <span class="link-text">Inicio</span>
            </a>
            <a href="/Camaras" class="nav-link">
                <span class="nav-icon"><i class="fas fa-camera"></i></span>
                <span class="link-text">Panel de Cámaras</span>
            </a>
            <a href="/Historial" class="nav-link">
                <span class="nav-icon"><i class="fas fa-history"></i></span>
                <span class="link-text">Historial</span>
            </a>
            <a href="/Administracion" class="nav-link">
                <span class="nav-icon"><i class="fas fa-user-cog"></i></span>
                <span class="link-text">Administración</span>
            </a>
            <a href="/Notificacion" class="nav-link">
                <span class="nav-icon"><i class="fas fa-bell"></i></span>
                <span class="link-text">Notificaciones</span>
                <span class="badge bg-danger ms-auto">3</span>
            </a>
            <a href="/Ajustes" class="nav-link">
                <span class="nav-icon"><i class="fas fa-cogs"></i></span>
                <span class="link-text">Ajustes</span>
            </a>
        </nav>
    </div>

    <!-- Contenido principal -->
    <div id="content">
        <div class="content-header">
            <h1>@yield('titulo')</h1>
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="d-none d-md-block">
                    <div class="fw-bold">Usuario Admin</div>
                    <small class="text-muted">Administrador</small>
                </div>
            </div>
        </div>
        
        @yield('contenido')
        
        <!-- Ejemplo de contenido mejorado -->
        <div class="row fade-in">
            <div class="col-md-6 delay-1">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-2"></i> Resumen de Actividad
                    </div>
                    <div class="card-body">
                        <p>Resumen de la actividad del sistema de vigilancia.</p>
                        <div class="mt-3">
                            <span class="status-badge status-active me-2">8 Cámaras Activas</span>
                            <span class="status-badge status-inactive">2 Cámaras Inactivas</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 delay-2">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-shield-alt me-2"></i> Estado del Sistema
                    </div>
                    <div class="card-body">
                        <p>El sistema está funcionando correctamente.</p>
                        <div class="progress mt-3" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} VideoVigilancia - Sistema de Seguridad Avanzado
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const particlesContainer = document.getElementById('particles-container');

        // Expandir al pasar el mouse
        sidebar.addEventListener('mouseenter', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.add('expanded');
                sidebar.classList.remove('collapsed');
                createParticles();
            }
        });

        // Colapsar al salir
        sidebar.addEventListener('mouseleave', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('expanded');
                sidebar.classList.add('collapsed');
            }
        });

        // Menú móvil
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('expanded');
            sidebar.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('expanded')) {
                createParticles();
            }
        });

        // Crear partículas para efecto decorativo
        function createParticles() {
            // Limpiar partículas existentes
            particlesContainer.innerHTML = '';
            
            // Crear nuevas partículas
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Posición aleatoria
                const size = Math.random() * 4 + 1;
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                const delay = Math.random() * 2;
                const duration = Math.random() * 3 + 2;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}%`;
                particle.style.top = `${posY}%`;
                particle.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Añadir animación flotante para las partículas
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0; }
                50% { transform: translateY(-20px) rotate(180deg); opacity: 0.7; }
            }
        `;
        document.head.appendChild(style);

        // Simular elemento activo en el menú
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>