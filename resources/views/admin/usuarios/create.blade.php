<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Usuario | Transporte S.A.</title>
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
        .form-input {
            transition: all 0.3s ease;
            position: relative;
        }
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
        }
        .form-label {
            transition: all 0.2s ease;
        }
        .form-group:focus-within .form-label {
            color: #6366f1;
            transform: scale(0.95);
        }
        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .submit-btn:hover::before {
            left: 100%;
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        .slide-up {
            animation: slideUp 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .strength-weak { background: #ef4444; width: 33%; }
        .strength-medium { background: #f59e0b; width: 66%; }
        .strength-strong { background: #10b981; width: 100%; }
        .role-preview {
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(10px);
        }
        .role-preview.show {
            opacity: 1;
            transform: translateY(0);
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
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Crear Usuario</h1>
                    <p class="text-sm text-gray-500">Registra un nuevo usuario en el sistema</p>
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

<main class="max-w-6xl mx-auto px-6 py-8">
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
                <form method="POST" action="{{ route('admin.usuarios.store') }}" class="p-6 space-y-6" novalidate enctype="multipart/form-data">
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

                    <!-- Campos adicionales para conductores -->
                    <div id="conductor-fields" class="space-y-4 hidden">
                        <!-- Fecha de expedición de la licencia -->
                        <div class="form-group">
                            <label for="fecha_expedicion_licencia" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Fecha de Expedición de la Licencia
                            </label>
                            <input type="date" id="fecha_expedicion_licencia" name="fecha_expedicion_licencia" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white" value="{{ old('fecha_expedicion_licencia') }}" />
                            @error('fecha_expedicion_licencia')
                                <p class="text-red-600 mt-2 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- Fecha de vencimiento de la licencia -->
                        <div class="form-group">
                            <label for="fecha_vencimiento_licencia" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                                <i class="fas fa-calendar-check mr-2 text-gray-400"></i>Fecha de Vencimiento de la Licencia
                            </label>
                            <input type="date" id="fecha_vencimiento_licencia" name="fecha_vencimiento_licencia" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white" value="{{ old('fecha_vencimiento_licencia') }}" />
                            @error('fecha_vencimiento_licencia')
                                <p class="text-red-600 mt-2 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- PDF de la licencia -->
                        <div class="form-group">
                            <label for="pdf_licencia" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                                <i class="fas fa-file-pdf mr-2 text-gray-400"></i>PDF de la Licencia de Conducción
                            </label>
                            <input type="file" id="pdf_licencia" name="pdf_licencia" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white" />
                            <span class="text-xs text-gray-500">Solo PDF</span>
                            @error('pdf_licencia')
                                <p class="text-red-600 mt-2 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- Número de cédula -->
                        <div class="form-group">
                            <label for="numero_cedula" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                                <i class="fas fa-id-card mr-2 text-gray-400"></i>Número de Cédula
                            </label>
                            <input type="text" id="numero_cedula" name="numero_cedula" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white" value="{{ old('numero_cedula') }}" />
                            @error('numero_cedula')
                                <p class="text-red-600 mt-2 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- PDF de la cédula -->
                        <div class="form-group">
                            <label for="pdf_cedula" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                                <i class="fas fa-file-pdf mr-2 text-gray-400"></i>PDF de la Cédula
                            </label>
                            <input type="file" id="pdf_cedula" name="pdf_cedula" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white" />
                            <span class="text-xs text-gray-500">Solo PDF</span>
                            @error('pdf_cedula')
                                <p class="text-red-600 mt-2 text-sm flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
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

<!-- Scripts para interacción -->
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

    // Mostrar/Ocultar contraseña
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');
    const passwordIcon = document.getElementById('password-icon');
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        });
    }

    // Vista previa de usuario
    function updatePreview() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const role = document.getElementById('role').value;

        document.getElementById('preview-name').textContent = name || 'Nombre del Usuario';
        document.getElementById('preview-email').textContent = email || 'correo@ejemplo.com';
        document.getElementById('preview-initial').textContent = name ? name.charAt(0).toUpperCase() : '?';
        document.getElementById('role-text').textContent = role ? role.charAt(0).toUpperCase() + role.slice(1) : 'Sin rol';

        const rolePreview = document.getElementById('preview-role');
        if (role) {
            rolePreview.classList.add('show');
        } else {
            rolePreview.classList.remove('show');
        }
    }
    document.getElementById('name').addEventListener('input', updatePreview);
    document.getElementById('email').addEventListener('input', updatePreview);
    document.getElementById('role').addEventListener('change', updatePreview);

    // Mostrar campos de conductor si el rol es conductor
    function toggleConductorFields() {
        const role = document.getElementById('role').value;
        const conductorFields = document.getElementById('conductor-fields');
        if (role && role.toLowerCase() === 'conductor') {
            conductorFields.classList.remove('hidden');
        } else {
            conductorFields.classList.add('hidden');
        }
    }
    document.getElementById('role').addEventListener('change', toggleConductorFields);
    // Inicializar visibilidad al cargar
    toggleConductorFields();

    // Validar que los archivos sean PDF
    document.getElementById('pdf_licencia')?.addEventListener('change', function(e) {
        if (this.files[0] && this.files[0].type !== 'application/pdf') {
            alert('Solo se permite subir archivos PDF para la licencia.');
            this.value = '';
        }
    });
    document.getElementById('pdf_cedula')?.addEventListener('change', function(e) {
        if (this.files[0] && this.files[0].type !== 'application/pdf') {
            alert('Solo se permite subir archivos PDF para la cédula.');
            this.value = '';
        }
    });

    // Fuerza de contraseña
    const passwordStrength = document.getElementById('password-strength');
    const passwordHelp = document.getElementById('password-help');
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const lowercaseCheck = document.getElementById('lowercase-check');
    const numberCheck = document.getElementById('number-check');
    passwordInput?.addEventListener('input', function() {
        const val = passwordInput.value;
        let strength = 0;
        if (val.length >= 8) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[a-z]/.test(val)) strength++;
        if (/\d/.test(val)) strength++;

        // Indicador visual
        passwordStrength.className = 'password-strength';
        if (strength === 0) {
            passwordStrength.style.width = '0%';
        } else if (strength === 1) {
            passwordStrength.classList.add('strength-weak');
        } else if (strength === 2 || strength === 3) {
            passwordStrength.classList.add('strength-medium');
        } else if (strength === 4) {
            passwordStrength.classList.add('strength-strong');
        }

        // Checks visuales
        lengthCheck.classList.toggle('text-green-500', val.length >= 8);
        lengthCheck.classList.toggle('text-gray-300', val.length < 8);
        uppercaseCheck.classList.toggle('text-green-500', /[A-Z]/.test(val));
        uppercaseCheck.classList.toggle('text-gray-300', !/[A-Z]/.test(val));
        lowercaseCheck.classList.toggle('text-green-500', /[a-z]/.test(val));
        lowercaseCheck.classList.toggle('text-gray-300', !/[a-z]/.test(val));
        numberCheck.classList.toggle('text-green-500', /\d/.test(val));
        numberCheck.classList.toggle('text-gray-300', !/\d/.test(val));
    });

    // Confirmación de contraseña
    const passwordConfirm = document.getElementById('password_confirmation');
    const passwordConfirmCheck = document.getElementById('password-confirm-check');
    const passwordConfirmError = document.getElementById('password-confirm-error');
    function checkPasswordMatch() {
        if (!passwordConfirm.value) {
            passwordConfirmCheck.classList.add('hidden');
            passwordConfirmError.classList.add('hidden');
            return;
        }
        if (passwordInput.value && passwordInput.value === passwordConfirm.value) {
            passwordConfirmCheck.classList.remove('hidden');
            passwordConfirmError.classList.add('hidden');
        } else {
            passwordConfirmCheck.classList.add('hidden');
            passwordConfirmError.classList.remove('hidden');
        }
    }
    passwordInput?.addEventListener('input', checkPasswordMatch);
    passwordConfirm?.addEventListener('input', checkPasswordMatch);

    // Inicializar preview al cargar
    updatePreview();
</script>
</body>
</html>

