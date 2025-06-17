@extends('layouts.admin')

@section('title', 'Vehículos | Transporte S.A.')
@section('header_icon', 'fas fa-truck')
@section('header_title', 'Gestión de Vehículos')
@section('header_subtitle', 'Control y administración de flota')

@section('content')
    <!-- Header de la página -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Lista de Vehículos</h2>
                <p class="text-gray-600">Administra y controla todos los vehículos de la empresa</p>
            </div>
            <div class="mt-4 lg:mt-0">
                <a href="{{ route('vehiculos.create') }}"
                   class="btn-gradient text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Nuevo Vehículo</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Vehículos -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl">
                    <i class="fas fa-truck text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">{{ count($vehiculos ?? []) }}</p>
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

        <!-- Vehículos con Conductor -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-xl">
                    <i class="fas fa-user-check text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Asignados</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">
                        {{ collect($vehiculos ?? [])->whereNotNull('conductor')->count() }}
                    </p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Con Conductor</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Operativos</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Disponibles
                </span>
            </div>
        </div>

        <!-- Vehículos sin Conductor -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl">
                    <i class="fas fa-user-slash text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Sin Asignar</p>
                    <p class="text-2xl font-bold text-gray-900 stat-counter">
                        {{ collect($vehiculos ?? [])->whereNull('conductor')->count() }}
                    </p>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Sin Conductor</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Pendientes</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                    Requieren asignación
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

    <!-- Tabla de vehículos -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header de la tabla -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <h3 class="text-xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-list mr-3 text-indigo-600"></i>
                Lista Completa de Vehículos
            </h3>
        </div>

        <!-- Tabla responsive -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <th class="text-left py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-id-card text-indigo-600"></i>
                                <span>Placa</span>
                            </div>
                        </th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-tag text-purple-600"></i>
                                <span>Tipo</span>
                            </div>
                        </th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-industry text-blue-600"></i>
                                <span>Marca</span>
                            </div>
                        </th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-car-side text-green-600"></i>
                                <span>Modelo</span>
                            </div>
                        </th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-800 uppercase tracking-wider text-sm">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user-tie text-orange-600"></i>
                                <span>Conductor</span>
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
                    @forelse($vehiculos as $index => $vehiculo)
                    <tr class="table-row-hover" style="animation-delay: {{ $index * 0.1 }}s">
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ strtoupper(substr($vehiculo->placa ?? 'XX', 0, 2)) }}
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900 text-lg">{{ $vehiculo->placa }}</span>
                                    <p class="text-xs text-gray-500">Identificación única</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="status-badge inline-flex items-center px-3 py-2 rounded-xl text-sm font-semibold bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 shadow-sm">
                                <i class="fas fa-tag mr-2"></i>
                                {{ $vehiculo->tipo }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-industry text-blue-500"></i>
                                <span class="text-gray-900 font-medium">{{ $vehiculo->marca ?? 'No especificada' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-car-side text-green-500"></i>
                                <span class="text-gray-700 font-medium">{{ $vehiculo->modelo ?? 'No especificado' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @if(optional($vehiculo->conductor)->name)
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <span class="text-gray-900 font-semibold">{{ $vehiculo->conductor->name }}</span>
                                    <p class="text-xs text-green-600 font-medium">Conductor asignado</p>
                                </div>
                            </div>
                            @else
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-gray-400 to-gray-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-slash text-white"></i>
                                </div>
                                <div>
                                    <span class="text-gray-600 font-medium">Sin asignar</span>
                                    <p class="text-xs text-orange-600 font-medium">Requiere conductor</p>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="{{ route('vehiculos.edit', $vehiculo) }}"
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                                   aria-label="Editar vehículo {{ $vehiculo->placa }}">
                                    <i class="fas fa-edit mr-2"></i>
                                    Editar
                                </a>
                                
                                <form action="{{ route('vehiculos.destroy', $vehiculo) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este vehículo?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 text-sm font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                                            aria-label="Eliminar vehículo {{ $vehiculo->placa }}">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="flex flex-col items-center space-y-4">
                                <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center shadow-inner">
                                    <i class="fas fa-truck text-gray-400 text-3xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">No hay vehículos registrados</h3>
                                    <p class="text-gray-600 mb-6">Comienza agregando tu primer vehículo a la flota</p>
                                </div>
                                <a href="{{ route('vehiculos.create') }}"
                                   class="btn-gradient text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 inline-flex items-center gap-3 text-lg">
                                    <i class="fas fa-plus"></i>
                                    <span>Agregar Primer Vehículo</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
