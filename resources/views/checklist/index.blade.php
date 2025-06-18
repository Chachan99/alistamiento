<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Ítems del Checklist | Transporte S.A.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-effect { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95);}
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);}
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 2px 8px 0 rgba(102,126,234,0.08);}
        .card-hover:hover { transform: translateY(-6px) scale(1.02); box-shadow: 0 16px 32px -8px rgba(102,126,234,0.15);}
        .table-row-hover { transition: all 0.2s ease-in-out;}
        .table-row-hover:hover { background: linear-gradient(90deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%); transform: translateX(6px) scale(1.01); box-shadow: 0 2px 8px 0 rgba(102,126,234,0.08);}
        .nav-link { position: relative; overflow: hidden;}
        .nav-link::before { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s ease;}
        .nav-link:hover::before { width: 100%;}
        .stat-counter { animation: countUp 1.5s ease-out;}
        @keyframes countUp { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: translateY(0);}}
        .btn-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; box-shadow: 0 2px 8px 0 rgba(102,126,234,0.10);}
        .btn-gradient:hover { background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%); transform: translateY(-2px) scale(1.03); box-shadow: 0 10px 25px rgba(102,126,234,0.18);}
        .status-badge { position: relative; overflow: hidden;}
        .status-badge::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); transition: left 0.5s;}
        .status-badge:hover::before { left: 100%;}
        .table thead th { background: linear-gradient(90deg, #eef2ff 0%, #f3e8ff 100%); }
        .table tbody tr { border-bottom: 1px solid #f3f4f6; }
        .table tbody tr:last-child { border-bottom: none; }
        .table { border-radius: 1rem; overflow: hidden; }
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
                    <i class="fas fa-clipboard-list text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Gestión de Ítems del Checklist</h1>
                    <p class="text-sm text-gray-500">Control y administración de ítems de alistamiento</p>
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
                <a href="{{ route('checklist.index') }}" class="nav-link text-indigo-600 font-semibold px-3 py-2 bg-indigo-50 rounded-lg">
                    <i class="fas fa-clipboard-check mr-2"></i>Checklist
                </a>
                <a href="{{ route('reportes.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
                    <i class="fas fa-chart-bar mr-2"></i>Reportes
                </a>
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
                <a href="{{ route('checklist.index') }}" class="flex items-center px-3 py-2 text-indigo-600 bg-indigo-50 rounded-lg font-semibold">
                    <i class="fas fa-clipboard-check mr-3"></i>Checklist
                </a>
                <a href="{{ route('reportes.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                    <i class="fas fa-chart-bar mr-3"></i>Reportes
                </a>
            </div>
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">
    <!-- Header de la página -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Ítems del Checklist</h2>
                <p class="text-gray-600">Administra y controla todos los ítems del checklist de alistamiento</p>
            </div>
            <div class="mt-4 lg:mt-0">
                <a href="{{ route('checklist.create') }}"
                   class="btn-gradient text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Nuevo Ítem</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Ítems -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl">
                    <i class="fas fa-clipboard-list text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">{{ count($items ?? []) }}</p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Ítems</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Checklist completo</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                    Registrados
                </span>
            </div>
        </div>
        <!-- Ítems activos -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Activos</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">
                        {{ collect($items ?? [])->where('activo', true)->count() }}
                    </p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Ítems Activos</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">En uso</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Habilitados
                </span>
            </div>
        </div>
        <!-- Ítems inactivos -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-red-500 to-red-600 rounded-xl">
                    <i class="fas fa-times-circle text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Inactivos</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">
                        {{ collect($items ?? [])->where('activo', false)->count() }}
                    </p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Ítems Inactivos</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">No disponibles</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    Deshabilitados
                </span>
            </div>
        </div>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg shadow-sm">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Tabla de ítems -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-list mr-3 text-indigo-600"></i>
                Lista Completa de Ítems
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <th class="text-left py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-list-check text-indigo-600"></i>
                                <span>Nombre</span>
                            </div>
                        </th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-toggle-on text-green-600"></i>
                                <span>Activo</span>
                            </div>
                        </th>
                        <th class="text-center py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-cogs text-gray-600"></i>
                                <span>Acciones</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
    @forelse($items as $index => $item)
    <tr class="table-row-hover" style="animation-delay: {{ $index * 0.1 }}s">
        <td class="py-4 px-6 font-medium text-gray-900">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                    <i class="fas fa-list-check"></i>
                </div>
                <span class="font-bold text-gray-900 text-lg">{{ $item->nombre }}</span>
            </div>
        </td>
        <td class="py-4 px-6">
            @if($item->activo)
                <span class="status-badge inline-flex items-center px-3 py-2 rounded-xl text-sm font-semibold bg-gradient-to-r from-green-100 to-green-200 text-green-800 shadow-sm">
                    <i class="fas fa-check-circle mr-2"></i>
                    Sí
                </span>
            @else
                <span class="status-badge inline-flex items-center px-3 py-2 rounded-xl text-sm font-semibold bg-gradient-to-r from-red-100 to-red-200 text-red-800 shadow-sm">
                    <i class="fas fa-times-circle mr-2"></i>
                    No
                </span>
            @endif
        </td>
        <td class="py-4 px-6 text-center">
            <div class="flex items-center justify-center space-x-3">
                <a href="{{ route('checklist.edit', $item) }}"
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                   aria-label="Editar ítem {{ $item->nombre }}">
                    <i class="fas fa-edit mr-2"></i>
                    Editar
                </a>
                <form action="{{ route('checklist.destroy', $item) }}"
                      method="POST"
                      onsubmit="return confirm('¿Estás seguro de eliminar este ítem?');"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                            aria-label="Eliminar ítem {{ $item->nombre }}">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Eliminar
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="3" class="py-16 text-center">
            <div class="flex flex-col items-center space-y-4">
                <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center shadow-inner">
                    <i class="fas fa-clipboard-list text-gray-400 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No hay ítems registrados</h3>
                    <p class="text-gray-600 mb-6">Comienza agregando tu primer ítem al checklist</p>
                </div>
                <a href="{{ route('checklist.create') }}"
                   class="btn-gradient text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 inline-flex items-center gap-3 text-lg">
                    <i class="fas fa-plus"></i>
                    <span>Agregar Primer Ítem</span>
                </a>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</main>

<!-- Footer profesional -->
<footer class="bg-white border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <div class="gradient-bg p-2 rounded-lg">
                    <i class="fas fa-clipboard-list text-white"></i>
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
    menuBtn?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        const icon = menuBtn.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });

    // Animación de números
    const animateCounters = () => {
        document.querySelectorAll('.stat-counter').forEach(counter => {
            const target = parseInt(counter.textContent);
            const increment = target / 50;
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

    // Animación de entrada para las filas de la tabla
    const tableRows = document.querySelectorAll('.table-row-hover');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        row.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(row);
    });

    // Inicializar animaciones cuando la página carga
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(animateCounters, 500);
    });
</script>
</body>
</html>