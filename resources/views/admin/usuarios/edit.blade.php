@extends('layouts.admin')

@section('title', 'Editar Usuario | Transporte S.A.')
@section('header_icon', 'fas fa-users-cog')
@section('header_title', 'Gestión de Usuarios')
@section('header_subtitle', 'Administración de perfiles y permisos')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-8 fade-in">
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
                        <a href="{{ route('admin.usuarios.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Usuarios</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-800 font-medium">Editar Usuario</span>
                    </div>
                </li>
            </ol>
        </nav>
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
                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 fade-in" role="alert">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400 text-lg"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Hay errores en el formulario</h3>
            </div>
        </div>
        <div class="ml-7">
            <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulario principal -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden slide-up">
                <!-- Header del formulario -->
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <i class="fas fa-user-edit text-indigo-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Información del Usuario</h2>
                            <p class="text-sm text-gray-500">Actualiza los datos del usuario seleccionado</p>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}" class="p-6 space-y-6" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Campo Nombre -->
                    <div class="form-group">
                        <label for="name" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                            <i class="fas fa-user mr-2 text-gray-400"></i>Nombre Completo
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $usuario->name) }}"
                                class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
                                required
                                autocomplete="name"
                                autofocus
                                placeholder="Ingresa el nombre completo"
                            />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-check text-green-500 hidden" id="name-check"></i>
                            </div>
                        </div>
                        @error('name')
                            <p class="text-red-600 mt-2 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Campo Email -->
                    <div class="form-group">
                        <label for="email" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                            <i class="fas fa-envelope mr-2 text-gray-400"></i>Correo Electrónico
                        </label>
                        <div class="relative">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $usuario->email) }}"
                                class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
                                required
                                autocomplete="email"
                                placeholder="correo@ejemplo.com"
                            />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-check text-green-500 hidden" id="email-check"></i>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-600 mt-2 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Campo Rol -->
                    <div class="form-group">
                        <label for="role" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                            <i class="fas fa-shield-alt mr-2 text-gray-400"></i>Rol del Usuario
                        </label>
                        <select
                            id="role"
                            name="role"
                            class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
                            required
                        >
                            <option value="">Selecciona un rol</option>
                            @foreach($roles as $rol)
                              <option
                                value="{{ $rol->name }}"
                                {{ (old('role', $usuario->roles->pluck('name')->first()) == $rol->name) ? 'selected' : '' }}
                              >
                                {{ ucfirst($rol->name) }}
                              </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-600 mt-2 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button
                            type="submit"
                            class="submit-btn flex-1 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Actualizar Usuario
                        </button>
                        <a
                            href="{{ route('admin.usuarios.index') }}"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-xl text-center transition-all duration-300 transform hover:-translate-y-1"
                        >
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Panel lateral -->
        <div class="lg:col-span-1">
            <div class="space-y-6">
                <!-- Vista previa del usuario -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 slide-up" style="animation-delay: 0.1s">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <i class="fas fa-eye text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Vista Previa</h3>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <span class="text-white font-bold text-2xl" id="preview-initial">{{ substr($usuario->name, 0, 1) }}</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-1" id="preview-name">{{ $usuario->name }}</h4>
                        <p class="text-gray-600 mb-2" id="preview-email">{{ $usuario->email }}</p>
                        <div class="role-preview" id="preview-role">
                            @php
                                $currentRole = $usuario->roles->pluck('name')->first() ?? 'Sin rol';
                                $roleClasses = [
                                    'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                    'jefe operativo' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'conductor' => 'bg-green-100 text-green-800 border-green-200',
                                    'default' => 'bg-gray-100 text-gray-800 border-gray-200'
                                ];
                                $roleClass = $roleClasses[strtolower($currentRole)] ?? $roleClasses['default'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $roleClass }}">
                                <i class="fas fa-shield-alt mr-1"></i>
                                <span id="role-text">{{ $currentRole }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Información</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">ID de Usuario:</span>
                            <span class="font-medium text-gray-900">#{{ $usuario->id }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Fecha de Registro:</span>
                            <span class="font-medium text-gray-900">{{ $usuario->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Última Actualización:</span>
                            <span class="font-medium text-gray-900">{{ $usuario->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-600">Estado:</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <div class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1 animate-pulse"></div>
                                Activo
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Consejos -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 p-6 slide-up" style="animation-delay: 0.3s">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <i class="fas fa-lightbulb text-indigo-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Consejos</h3>
                    </div>
                    
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
                            <span>Asegúrate de que el correo sea válido y único</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
                            <span>El rol determina los permisos del usuario</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
                            <span>Los cambios se aplicarán inmediatamente</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
