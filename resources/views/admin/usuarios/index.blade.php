<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Usuarios | Transporte S.A.</title>
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
        .table-row-hover {
            transition: all 0.2s ease;
        }
        .table-row-hover:hover {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.02), rgba(139, 92, 246, 0.02));
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
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
        .role-badge {
            position: relative;
            overflow: hidden;
        }
        .role-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        .role-badge:hover::before {
            left: 100%;
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
                    <i class="fas fa-users-cog text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Gestión de Usuarios</h1>
                    <p class="text-sm text-gray-500">Administración de perfiles y permisos</p>
                </div>
            </div>

            <!-- Navegación desktop -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.usuarios.index') }}" class="nav-link text-indigo-600 font-medium px-3 py-2 border-b-2 border-indigo-600">
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
                <a href="{{ route('admin.usuarios.index') }}" class="flex items-center px-3 py-2 bg-indigo-50 text-indigo-600 rounded-lg">
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
    <!-- Breadcrumb y título -->
    <div class="mb-8">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-800 font-medium">Usuarios</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Gestión de Usuarios</h2>
                <p class="text-gray-600">Administra los usuarios, roles y permisos del sistema</p>
            </div>
        </div>
    </div>

    <!-- Alertas -->
    @if(session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 fade-in" role="alert">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400 text-lg"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Panel principal -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden fade-in">
        <!-- Header del panel -->
        <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <i class="fas fa-users text-indigo-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Lista de Usuarios</h3>
                        <p class="text-sm text-gray-500">{{ $usuarios->count() }} usuarios registrados</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Buscador -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="searchInput" placeholder="Buscar usuarios..." 
                               class="search-input block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                    
                    <!-- Botón nuevo usuario -->
                    <a href="{{ route('admin.usuarios.create') }}" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                        <i class="fas fa-user-plus mr-2"></i>
                        Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>

        <!-- Filtros rápidos -->
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-sm font-medium text-gray-700 mr-2">Filtrar por rol:</span>
                <button onclick="filterByRole('all')" class="filter-btn px-3 py-1 text-xs font-medium rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">
                    Todos
                </button>
                <button onclick="filterByRole('admin')" class="filter-btn px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700 hover:bg-purple-200 transition-colors">
                    Administradores
                </button>
                <button onclick="filterByRole('jefe')" class="filter-btn px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">
                    Jefes Operativos
                </button>
                <button onclick="filterByRole('conductor')" class="filter-btn px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 hover:bg-green-200 transition-colors">
                    Conductores
                </button>
            </div>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-user text-gray-400"></i>
                                <span>Usuario</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-envelope text-gray-400"></i>
                                <span>Correo Electrónico</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-shield-alt text-gray-400"></i>
                                <span>Rol</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock text-gray-400"></i>
                                <span>Estado</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <i class="fas fa-cogs text-gray-400"></i>
                                <span>Acciones</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
                    @foreach($usuarios as $usuario)
                    <tr class="table-row-hover user-row" data-name="{{ strtolower($usuario->name) }}" data-email="{{ strtolower($usuario->email) }}" data-role="{{ strtolower($usuario->roles->pluck('name')->first() ?? 'sin-rol') }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                        <span class="text-white font-semibold text-sm">{{ substr($usuario->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $usuario->name }}</div>
                                    <div class="text-sm text-gray-500">ID: #{{ $usuario->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $usuario->email }}</div>
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-at mr-1"></i>Correo verificado
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $role = $usuario->roles->pluck('name')->first() ?? 'Sin rol';
                                $roleClasses = [
                                    'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                    'jefe operativo' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'conductor' => 'bg-green-100 text-green-800 border-green-200',
                                    'default' => 'bg-gray-100 text-gray-800 border-gray-200'
                                ];
                                $roleClass = $roleClasses[strtolower($role)] ?? $roleClasses['default'];
                            @endphp
                            <span class="role-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $roleClass }}">
                                @if(strtolower($role) === 'admin')
                                    <i class="fas fa-crown mr-1"></i>
                                @elseif(strtolower($role) === 'jefe operativo')
                                    <i class="fas fa-user-tie mr-1"></i>
                                @elseif(strtolower($role) === 'conductor')
                                    <i class="fas fa-id-badge mr-1"></i>
                                @else
                                    <i class="fas fa-user mr-1"></i>
                                @endif
                                {{ $role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <div class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5 animate-pulse"></div>
                                Activo
                            </span>
                            <div class="text-xs text-gray-500 mt-1">Última conexión: Hoy</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="{{ route('admin.usuarios.edit', $usuario) }}" 
                                   class="action-btn text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 p-2 rounded-lg transition-all"
                                   aria-label="Editar usuario {{ $usuario->name }}" title="Editar usuario">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="viewUserDetails({{ $usuario->id }}, '{{ $usuario->name }}', '{{ $usuario->email }}', '{{ $role }}')"
                                        class="action-btn text-blue-600 hover:text-blue-900 hover:bg-blue-50 p-2 rounded-lg transition-all"
                                        title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                            class="action-btn text-red-600 hover:text-red-900 hover:bg-red-50 p-2 rounded-lg transition-all"
                                            aria-label="Eliminar usuario {{ $usuario->name }}" title="Eliminar usuario">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if($usuarios->isEmpty())
                    <tr id="emptyState">
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-users text-gray-300 text-6xl mb-4"></i>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay usuarios registrados</h3>
                                <p class="text-gray-500 mb-4">Comienza agregando el primer usuario al sistema</p>
                                <a href="{{ route('admin.usuarios.create') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Agregar Usuario
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Footer de la tabla con paginación -->
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Mostrando <span class="font-medium">{{ $usuarios->count() }}</span> usuarios
                </div>
                <div class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Última actualización: {{ now()->format('d/m/Y H:i') }}
                </div>
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

<!-- Modal para ver detalles del usuario -->
<div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 m-4 max-w-md w-full shadow-2xl">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Detalles del Usuario</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="modalContent">
            <!-- El contenido se llenará dinámicamente -->
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Cerrar
            </button>
        </div>
    </div>
</div>

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

    // Función de búsqueda
    const searchInput = document.getElementById('searchInput');
    const userRows = document.querySelectorAll('.user-row');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleRows = 0;

        userRows.forEach(row => {
            const name = row.dataset.name;
            const email = row.dataset.email;
            const role = row.dataset.role;

            if (name.includes(searchTerm) || email.includes(searchTerm) || role.includes(searchTerm)) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        // Mostrar mensaje si no hay resultados
        showNoResults(visibleRows === 0 && searchTerm !== '');
    });

    // Filtro por rol
    function filterByRole(role) {
        const filterButtons = document.querySelectorAll('.filter-btn');
        filterButtons.forEach(btn => {
            btn.classList.remove('bg-indigo-200', 'text-indigo-800');
            btn.classList.add('bg-gray-200', 'text-gray-700');
        });

        event.target.classList.remove('bg-gray-200', 'text-gray-700');
        event.target.classList.add('bg-indigo-200', 'text-indigo-800');

        let visibleRows = 0;

        userRows.forEach(row => {
            const userRole = row.dataset.role;
            if (role === 'all' || userRole.includes(role)) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        showNoResults(visibleRows === 0);
    }

    // Mostrar estado sin resultados
    function showNoResults(show) {
        const tbody = document.getElementById('usersTableBody');
        let noResultsRow = document.getElementById('noResultsRow');

        if (show) {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.id = 'noResultsRow';
                noResultsRow.innerHTML = `
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-search text-gray-300 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No se encontraron usuarios</h3>
                            <p class="text-gray-500">Intenta con otros términos de búsqueda</p>
                        </div>
                    </td>
                `;
                tbody.appendChild(noResultsRow);
            }
        } else {