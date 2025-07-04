<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Vehículo | Transporte S.A.</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; background: #f9fafb; }
    .glass-effect { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95);}
    .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);}
    .nav-link { position: relative; overflow: hidden;}
    .nav-link::before { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s ease;}
    .nav-link:hover::before { width: 100%;}
    .form-input { transition: all 0.3s ease; position: relative;}
    .form-input:focus { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);}
    .form-label { transition: all 0.2s ease;}
    .form-group:focus-within .form-label { color: #6366f1; transform: scale(0.95);}
    .submit-btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative; overflow: hidden;}
    .submit-btn::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: left 0.5s;}
    .submit-btn:hover::before { left: 100%;}
    .fade-in { animation: fadeIn 0.6s ease-out;}
    .slide-up { animation: slideUp 0.5s ease-out;}
    @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
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
          <i class="fas fa-truck text-white text-xl"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Editar Vehículo</h1>
          <p class="text-sm text-gray-500">Actualiza la información del vehículo</p>
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
        <a href="{{ route('vehiculos.index') }}" class="nav-link text-indigo-600 font-semibold px-3 py-2 bg-indigo-50 rounded-lg">
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
        <a href="{{ route('vehiculos.index') }}" class="flex items-center px-3 py-2 text-indigo-600 bg-indigo-50 rounded-lg font-semibold">
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

<main class="max-w-4xl mx-auto px-6 py-8">
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
            <a href="{{ route('vehiculos.index') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">Vehículos</a>
          </div>
        </li>
        <li>
          <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
            <span class="text-gray-800 font-medium">Editar Vehículo</span>
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
              <i class="fas fa-truck text-indigo-600"></i>
            </div>
            <div>
              <h2 class="text-lg font-semibold text-gray-900">Información del Vehículo</h2>
              <p class="text-sm text-gray-500">Actualiza los datos del vehículo seleccionado</p>
            </div>
          </div>
        </div>

        <!-- Formulario -->
        <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST" class="p-6 space-y-6" novalidate enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Placa -->
          <div class="form-group">
            <label for="placa" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-id-card mr-2 text-gray-400"></i>Placa
            </label>
            <input
              type="text"
              id="placa"
              name="placa"
              value="{{ old('placa', $vehiculo->placa) }}"
              class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
              required
              autocomplete="off"
              placeholder="Ej: ABC123"
            />
            @error('placa')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>

          <!-- Tipo -->
          <div class="form-group">
            <label for="tipo" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-tag mr-2 text-gray-400"></i>Tipo
            </label>
            <input
              type="text"
              id="tipo"
              name="tipo"
              value="{{ old('tipo', $vehiculo->tipo) }}"
              class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
              required
              autocomplete="off"
              placeholder="Ej: Camión, Furgón, etc."
            />
            @error('tipo')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>

          <!-- Marca -->
          <div class="form-group">
            <label for="marca" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-industry mr-2 text-gray-400"></i>Marca
            </label>
            <input
              type="text"
              id="marca"
              name="marca"
              value="{{ old('marca', $vehiculo->marca) }}"
              class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
              autocomplete="off"
              placeholder="Ej: Chevrolet, Renault, etc."
            />
            @error('marca')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>

          <!-- Modelo -->
          <div class="form-group">
            <label for="modelo" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-car-side mr-2 text-gray-400"></i>Modelo
            </label>
            <input
              type="text"
              id="modelo"
              name="modelo"
              value="{{ old('modelo', $vehiculo->modelo) }}"
              class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
              autocomplete="off"
              placeholder="Ej: 2020"
            />
            @error('modelo')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>

          <!-- Conductor asignado -->
          <div class="form-group">
            <label for="user_id" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-user-tie mr-2 text-gray-400"></i>Conductor asignado (opcional)
            </label>
            <select
              id="user_id"
              name="user_id"
              class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 focus:bg-white"
            >
              <option value="">Sin asignar</option>
              @foreach($conductores as $conductor)
                <option
                  value="{{ $conductor->id }}"
                  {{ old('user_id', $vehiculo->user_id) == $conductor->id ? 'selected' : '' }}
                >
                  {{ $conductor->name }}
                </option>
              @endforeach
            </select>
            @error('user_id')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>

          <!-- SOAT PDF -->
          <div class="form-group">
            <label for="soat_pdf" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-file-pdf mr-2 text-gray-400"></i>SOAT (PDF)
            </label>
            <input type="file" id="soat_pdf" name="soat_pdf" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50" />
            @if($vehiculo->soat_pdf)
              <p class="text-xs mt-2">Actual: <a href="{{ asset('storage/' . $vehiculo->soat_pdf) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a></p>
            @else
              <p class="text-xs text-gray-400 mt-2">Sin archivos seleccionados</p>
            @endif
            @error('soat_pdf')
              <p class="text-red-600 mt-2 text-sm flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Técnico Mecánica PDF -->
          <div class="form-group">
            <label for="tecnico_mecanica_pdf" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-file-pdf mr-2 text-gray-400"></i>Técnico Mecánica (PDF)
            </label>
            <input type="file" id="tecnico_mecanica_pdf" name="tecnico_mecanica_pdf" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50" />
            @if($vehiculo->tecnico_mecanica_pdf)
              <p class="text-xs mt-2">Actual: <a href="{{ asset('storage/' . $vehiculo->tecnico_mecanica_pdf) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a></p>
            @else
              <p class="text-xs text-gray-400 mt-2">Sin archivos seleccionados</p>
            @endif
            @error('tecnico_mecanica_pdf')
              <p class="text-red-600 mt-2 text-sm flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Licencia de Tránsito PDF -->
          <div class="form-group">
            <label for="licencia_transito_pdf" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-file-pdf mr-2 text-gray-400"></i>Licencia de Tránsito (PDF)
            </label>
            <input type="file" id="licencia_transito_pdf" name="licencia_transito_pdf" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50" />
            @if($vehiculo->licencia_transito_pdf)
              <p class="text-xs mt-2">Actual: <a href="{{ asset('storage/' . $vehiculo->licencia_transito_pdf) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a></p>
            @else
              <p class="text-xs text-gray-400 mt-2">Sin archivos seleccionados</p>
            @endif
            @error('licencia_transito_pdf')
              <p class="text-red-600 mt-2 text-sm flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
            @enderror
          </div>

          <!-- Fechas SOAT -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group">
              <label for="soat_expedicion" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Expedición SOAT
              </label>
              <input type="date" id="soat_expedicion" name="soat_expedicion" value="{{ old('soat_expedicion', $vehiculo->soat_expedicion) }}" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50" placeholder="dd/mm/aaaa" />
              @error('soat_expedicion')
                <p class="text-red-600 mt-2 text-sm flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="soat_vencimiento" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Vencimiento SOAT
              </label>
              <input type="date" id="soat_vencimiento" name="soat_vencimiento" value="{{ old('soat_vencimiento', $vehiculo->soat_vencimiento) }}" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50" placeholder="dd/mm/aaaa" />
              @error('soat_vencimiento')
                <p class="text-red-600 mt-2 text-sm flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Fechas Técnico Mecánica -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group">
              <label for="tecnico_mecanica_expedicion" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Expedición Técnico Mecánica
              </label>
              <input type="date" id="tecnico_mecanica_expedicion" name="tecnico_mecanica_expedicion" value="{{ old('tecnico_mecanica_expedicion', $vehiculo->tecnico_mecanica_expedicion) }}" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50" placeholder="dd/mm/aaaa" />
              @error('tecnico_mecanica_expedicion')
                <p class="text-red-600 mt-2 text-sm flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="tecnico_mecanica_vencimiento" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Vencimiento Técnico Mecánica
              </label>
              <input type="date" id="tecnico_mecanica_vencimiento" name="tecnico_mecanica_vencimiento" value="{{ old('tecnico_mecanica_vencimiento', $vehiculo->tecnico_mecanica_vencimiento) }}" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-50" placeholder="dd/mm/aaaa" />
              @error('tecnico_mecanica_vencimiento')
                <p class="text-red-600 mt-2 text-sm flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Botones de acción -->
          <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
            <button
              type="submit"
              class="submit-btn flex-1 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
            >
              <i class="fas fa-save mr-2"></i>
              Actualizar Vehículo
            </button>
            <a
              href="{{ route('vehiculos.index') }}"
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
        <!-- Vista previa del vehículo -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 slide-up" style="animation-delay: 0.1s">
          <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-purple-100 rounded-lg">
              <i class="fas fa-eye text-purple-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Vista Previa</h3>
          </div>
          <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
              <span class="text-white font-bold text-2xl" id="preview-placa">{{ strtoupper(substr($vehiculo->placa, 0, 2)) }}</span>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 mb-1" id="preview-placa-full">{{ $vehiculo->placa }}</h4>
            <p class="text-gray-600 mb-2" id="preview-tipo">{{ $vehiculo->tipo }}</p>
            <div class="mb-2">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-blue-100 text-blue-800 border-blue-200" id="preview-marca">
                <i class="fas fa-industry mr-1"></i>
                {{ $vehiculo->marca ?? 'Sin marca' }}
              </span>
            </div>
            <div>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-green-100 text-green-800 border-green-200" id="preview-modelo">
                <i class="fas fa-car-side mr-1"></i>
                {{ $vehiculo->modelo ?? 'Sin modelo' }}
              </span>
            </div>
            <div class="mt-4">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-gray-100 text-gray-800 border-gray-200" id="preview-conductor">
                <i class="fas fa-user-tie mr-1"></i>
                {{ optional($vehiculo->conductor)->name ?? 'Sin conductor' }}
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
              <span class="text-gray-600">ID Vehículo:</span>
              <span class="font-medium text-gray-900">#{{ $vehiculo->id }}</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-100">
              <span class="text-gray-600">Fecha de Registro:</span>
              <span class="font-medium text-gray-900">{{ $vehiculo->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-gray-100">
              <span class="text-gray-600">Última Actualización:</span>
              <span class="font-medium text-gray-900">{{ $vehiculo->updated_at->format('d/m/Y H:i') }}</span>
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
              <span>Verifica que la placa sea única y válida</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
              <span>Asigna un conductor si es necesario</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mr-2 mt-0.5 text-xs"></i>
              <span>Los cambios se aplican inmediatamente</span>
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

  // Vista previa en tiempo real
  const placaInput = document.getElementById('placa');
  const tipoInput = document.getElementById('tipo');
  const marcaInput = document.getElementById('marca');
  const modeloInput = document.getElementById('modelo');
  const conductorSelect = document.getElementById('user_id');

  const previewPlaca = document.getElementById('preview-placa');
  const previewPlacaFull = document.getElementById('preview-placa-full');
  const previewTipo = document.getElementById('preview-tipo');
  const previewMarca = document.getElementById('preview-marca');
  const previewModelo = document.getElementById('preview-modelo');
  const previewConductor = document.getElementById('preview-conductor');

  placaInput?.addEventListener('input', function() {
    previewPlaca.textContent = this.value ? this.value.substring(0,2).toUpperCase() : 'XX';
    previewPlacaFull.textContent = this.value || 'Placa';
  });
  tipoInput?.addEventListener('input', function() {
    previewTipo.textContent = this.value || 'Tipo';
  });
  marcaInput?.addEventListener('input', function() {
    previewMarca.innerHTML = `<i class="fas fa-industry mr-1"></i> ${this.value || 'Sin marca'}`;
  });
  modeloInput?.addEventListener('input', function() {
    previewModelo.innerHTML = `<i class="fas fa-car-side mr-1"></i> ${this.value || 'Sin modelo'}`;
  });
  conductorSelect?.addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    previewConductor.innerHTML = `<i class="fas fa-user-tie mr-1"></i> ${selected.value ? selected.text : 'Sin conductor'}`;
  });

  // Inicializar preview al cargar
  document.addEventListener('DOMContentLoaded', function() {
    if (placaInput) {
      previewPlaca.textContent = placaInput.value ? placaInput.value.substring(0,2).toUpperCase() : 'XX';
      previewPlacaFull.textContent = placaInput.value || 'Placa';
    }
    if (tipoInput) previewTipo.textContent = tipoInput.value || 'Tipo';
    if (marcaInput) previewMarca.innerHTML = `<i class="fas fa-industry mr-1"></i> ${marcaInput.value || 'Sin marca'}`;
    if (modeloInput) previewModelo.innerHTML = `<i class="fas fa-car-side mr-1"></i> ${modeloInput.value || 'Sin modelo'}`;
    if (conductorSelect) {
      const selected = conductorSelect.options[conductorSelect.selectedIndex];
      previewConductor.innerHTML = `<i class="fas fa-user-tie mr-1"></i> ${selected.value ? selected.text : 'Sin conductor'}`;
    }
  });
</script>
</body>
</html>