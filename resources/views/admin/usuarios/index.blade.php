@extends('layouts.admin')

@section('title', 'Usuarios | Transporte S.A.')
@section('header_icon', 'fas fa-users-cog')
@section('header_title', 'Gestión de Usuarios')
@section('header_subtitle', 'Administración de perfiles y permisos')

@section('content')
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
@endsection
