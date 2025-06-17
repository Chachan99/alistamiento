@extends('layouts.admin')

@section('title', 'Panel de Administración | Transporte S.A.')
@section('header_icon', 'fas fa-chart-line')
@section('header_title', 'Panel de Control')
@section('header_subtitle', 'Sistema de Gestión Empresarial')

@section('content')
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

    <!-- Estadísticas principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
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
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Activos</span>
            </div>
        </div>
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
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Disponibles</span>
            </div>
        </div>
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
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Activos</span>
            </div>
        </div>
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
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Online</span>
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
            <div class="text-center p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-100">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mb-4 shadow-lg">
                    <i class="fas fa-check-circle text-white text-2xl"></i>
                </div>
                <p class="text-3xl font-bold text-green-700 mb-1 stat-counter">{{ $alistamientosAprobados }}</p>
                <p class="text-green-600 font-medium">Aprobados</p>
                <p class="text-sm text-green-500 mt-2">Listos para operar</p>
            </div>
            <div class="text-center p-6 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl border border-yellow-100">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-500 to-amber-600 rounded-full mb-4 shadow-lg">
                    <i class="fas fa-hourglass-half text-white text-2xl"></i>
                </div>
                <p class="text-3xl font-bold text-yellow-700 mb-1 stat-counter">{{ $alistamientosPendientes }}</p>
                <p class="text-yellow-600 font-medium">Pendientes</p>
                <p class="text-sm text-yellow-500 mt-2">En revisión</p>
            </div>
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

    <!-- Accesos rápidos -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
@endsection

@push('scripts')
<script>
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
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(animateCounters, 500);
    });
</script>
@endpush
