@extends('layouts.admin')

@section('title', 'Crear Usuario | Transporte S.A.')
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
                        <span class="text-gray-800 font-medium">Crear Usuario</span>
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
                            <i class="fas fa-user-plus text-indigo-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Nuevo Usuario</h2>
                            <p class="text-sm text-gray-500">Completa todos los campos para registrar el usuario</p>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form method="POST" action="{{ route('admin.usuarios.store') }}" class="p-6 space-y-6" novalidate>
                    @csrf

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
                                value="{{ old('name') }}"
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
                                value="{{ old('email') }}"
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

                    <!-- Campo Contraseña -->
                    <div class="form-group">
                        <label for="password" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>Contraseña
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white pr-12"
                                required
                                autocomplete="new-password"
                                placeholder="Ingresa una contraseña segura"
                            />
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="password-icon"></i>
                            </button>
                        </div>
                        <!-- Indicador de fuerza de contraseña -->
                        <div class="mt-2">
                            <div class="bg-gray-200 rounded-full h-1">
                                <div class="password-strength" id="password-strength"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1" id="password-help">
                                Mínimo 8 caracteres, incluye mayúsculas, minúsculas y números
                            </p>
                        </div>
                        @error('password')
                            <p class="text-red-600 mt-2 text-sm flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Campo Confirmar Contraseña -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>Confirmar Contraseña
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
                                required
                                autocomplete="new-password"
                                placeholder="Confirma la contraseña"
                            />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-check text-green-500 hidden" id="password-confirm-check"></i>
                                <i class="fas fa-times text-red-500 hidden" id="password-confirm-error"></i>
                            </div>
                        </div>
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
                                {{ old('role') == $rol->name ? 'selected' : '' }}
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
                            <i class="fas fa-user-plus mr-2"></i>
                            Crear Usuario
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
                            <span class="text-white font-bold text-2xl" id="preview-initial">?</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-1" id="preview-name">Nombre del Usuario</h4>
                        <p class="text-gray-600 mb-2" id="preview-email">correo@ejemplo.com</p>
                        <div class="role-preview" id="preview-role">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-gray-100 text-gray-800 border-gray-200" id="role-badge">
                                <i class="fas fa-shield-alt mr-1"></i>
                                <span id="role-text">Sin rol</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Guía de contraseñas -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <i class="fas fa-shield-alt text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Seguridad</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500" id="length-check"></i>
                            <span class="text-gray-600">Mínimo 8 caracteres</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-gray-300" id="uppercase-check"></i>
                            <span class="text-gray-600">Al menos una mayúscula</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-gray-300" id="lowercase-check"></i>
                            <span class="text-gray-600">Al menos una minúscula</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-gray-300" id="number-check"></i>
                            <span class="text-gray-600">Al menos un número</span>
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
                            <span>Usa un correo válido y único</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
                            <span>Elige una contraseña segura</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
                            <span>Selecciona el rol apropiado</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
                            <span>El usuario podrá cambiar su contraseña</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
