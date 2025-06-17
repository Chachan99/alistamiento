<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Panel de Administración | Transporte S.A.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .stat-counter {
            animation: countUp 1.5s ease-out;
        }
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }
        .nav-link:hover::before {
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

<!-- Header con efecto glassmorphism -->
<header class="glass-effect sticky top-0 z-50 border-b border-white/20 shadow-lg">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo y título -->
            <div class="flex items-center space-x-4">
                <div class="gradient-bg p-3 rounded-xl shadow-lg">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Panel de Control</h1>
                    <p class="text-sm text-gray-500">Sistema de Gestión Empresarial</p>
                </div>
            </div>

            <!-- Navegación desktop -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
                    <i class="fas fa-users mr-2"></i>Usuarios
                </a>
                <a href="{{ route('vehiculos.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
                    <i class="fas fa-truck mr-2"></i>Vehículos
                </a>
                <a href="{{ route('checklist.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
                    <i class="fas fa-clipboard-check mr-2"></i>Checklist
                </a>
                <a href="{{ route('reportes.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
                    <i class="fas fa-chart-bar mr-2"></i>Reportes
                </a>
                
                <!-- Perfil y logout -->
                <div class="flex items-center space-x-4 ml-8 pl-8 border-l border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Administrador</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-red-50">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Botón menú móvil -->
            <button id="menu-btn" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Menú móvil -->
        <nav id="mobile-menu" class="lg:hidden mt-4 pb-4 border-t border-gray-200 hidden">
            <div class="pt-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                    <i class="fas fa-users mr-3"></i>Usuarios
                </a>
                <a href="{{ route('vehiculos.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                    <i class="fas fa-truck mr-3"></i>Vehículos
                </a>
                <a href="{{ route('checklist.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                    <i class="fas fa-clipboard-check mr-3"></i>Checklist
                </a>
                <a href="{{ route('reportes.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                    <i class="fas fa-chart-bar mr-3"></i>Reportes
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-gray-200">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt mr-3"></i>Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">
    <!-- Bienvenida y acciones rápidas -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Bienvenido al Dashboard</h2>
                <p class="text-gray-600">Gestiona y supervisa todas las operaciones de tu empresa</p>
            </div>
            <div class="mt-4 lg:mt-0">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.usuarios.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus mr-2"></i>Nuevo Usuario
                    </a>
                    <a href="{{ route('vehiculos.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                        <i class="fas fa-truck mr-2"></i>Agregar Vehículo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas principales en grid mejorado -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- Tarjeta Vehículos -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl">
                    <i class="fas fa-truck text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">{{ $totalVehiculos }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Vehículos</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Flota completa</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    Activos
                </span>
            </div>
        </div>

        <!-- Tarjeta Conductores -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl">
                    <i class="fas fa-id-badge text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">{{ $totalConductores }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Conductores</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Personal operativo</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Disponibles
                </span>
            </div>
        </div>

        <!-- Tarjeta Jefes Operativos -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl">
                    <i class="fas fa-user-tie text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">{{ $totalJefes }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Jefes Operativos</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Supervisión</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                    Activos
                </span>
            </div>
        </div>

        <!-- Tarjeta Administradores -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl">
                    <i class="fas fa-user-shield text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">{{ $totalAdmins }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Administradores</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Gestión sistema</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                    Online
                </span>
            </div>
        </div>
    </div>

    <!-- Sección de Alistamientos -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">Estado de Alistamientos</h3>
            <a href="{{ route('checklist.index') }}" class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center">
                Ver todos <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Aprobados -->
            <div class="text-center p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-100">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mb-4 shadow-lg">
                    <i class="fas fa-check-circle text-white text-2xl"></i>
                </div>
                <p class="text-3xl font-bold text-green-700 mb-1 stat-counter">{{ $alistamientosAprobados }}</p>
                <p class="text-green-600 font-medium">Aprobados</p>
                <p class="text-sm text-green-500 mt-2">Listos para operar</p>
            </div>

            <!-- Pendientes -->
            <div class="text-center p-6 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl border border-yellow-100">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-500 to-amber-600 rounded-full mb-4 shadow-lg">
                    <i class="fas fa-hourglass-half text-white text-2xl"></i>
                </div>
                <p class="text-3xl font-bold text-yellow-700 mb-1 stat-counter">{{ $alistamientosPendientes }}</p>
                <p class="text-yellow-600 font-medium">Pendientes</p>
                <p class="text-sm text-yellow-500 mt-2">En revisión</p>
            </div>

            <!-- Rechazados -->
            <div class="text-center p-6 bg-gradient-to-r from-red-50 to-rose-50 rounded-xl border border-red-100">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-red-500 to-rose-600 rounded-full mb-4 shadow-lg">
                    <i class="fas fa-times-circle text-white text-2xl"></i>
                </div>
                <p class="text-3xl font-bold text-red-700 mb-1 stat-counter">{{ $alistamientosRechazados }}</p>
                <p class="text-red-600 font-medium">Rechazados</p>
                <p class="text-sm text-red-500 mt-2">Requieren atención</p>
            </div>
        </div>
    </div>

    <!-- Accesos rápidos mejorados -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Gestión de Personal -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-lg text-white p-8 card-hover">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Gestión de Personal</h3>
                    <p class="text-blue-100">Administra usuarios y roles del sistema</p>
                </div>
                <div class="p-4 bg-white/10 rounded-xl backdrop-blur-sm">
                    <i class="fas fa-users text-3xl"></i>
                </div>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.usuarios.index') }}" class="flex-1 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg px-4 py-3 text-center transition-all duration-200 border border-white/20">
                    <i class="fas fa-user-plus mb-2 block"></i>
                    <span class="text-sm font-medium">Usuarios</span>
                </a>
                <a href="{{ route('reportes.index') }}" class="flex-1 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg px-4 py-3 text-center transition-all duration-200 border border-white/20">
                    <i class="fas fa-chart-line mb-2 block"></i>
                    <span class="text-sm font-medium">Reportes</span>
                </a>
            </div>
        </div>

        <!-- Gestión de Flota -->
        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-2xl shadow-lg text-white p-8 card-hover">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Gestión de Flota</h3>
                    <p class="text-emerald-100">Control y monitoreo vehicular</p>
                </div>
                <div class="p-4 bg-white/10 rounded-xl backdrop-blur-sm">
                    <i class="fas fa-truck text-3xl"></i>
                </div>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('vehiculos.index') }}" class="flex-1 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg px-4 py-3 text-center transition-all duration-200 border border-white/20">
                    <i class="fas fa-plus-circle mb-2 block"></i>
                    <span class="text-sm font-medium">Vehículos</span>
                </a>
                <a href="{{ route('checklist.index') }}" class="flex-1 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-lg px-4 py-3 text-center transition-all duration-200 border border-white/20">
                    <i class="fas fa-clipboard-check mb-2 block"></i>
                    <span class="text-sm font-medium">Checklist</span>
                </a>
            </div>
        </div>
    </div>
</main>

<!-- Footer profesional -->
<footer class="bg-white border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <div class="gradient-bg p-2 rounded-lg">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Transporte S.A.</p>
                    <p class="text-sm text-gray-500">Sistema de Gestión Empresarial</p>
                </div>
            </div>
            <div class="text-center md:text-right">
                <p class="text-sm text-gray-500">© 2024 Todos los derechos reservados</p>
                <p class="text-xs text-gray-400 mt-1">Versión 2.1.0</p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Menú móvil
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        const icon = menuBtn.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });

    // Animación de números
    const animateCounters = () => {
        document.querySelectorAll('.stat-counter').forEach(counter => {
            const target = parseInt(counter.textContent);
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.ceil(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
    };

    // Inicializar animaciones cuando la página carga
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(animateCounters, 500);
    });

    // Smooth scroll para navegación
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>

</body>
</html>