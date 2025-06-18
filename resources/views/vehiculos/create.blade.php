<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registrar Nuevo Vehículo | Transporte S.A.</title>
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
      <div class="flex items-center space-x-4">
        <div class="gradient-bg p-3 rounded-xl shadow-lg">
          <i class="fas fa-truck text-white text-xl"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Registrar Nuevo Vehículo</h1>
          <p class="text-sm text-gray-500">Agrega un vehículo a la flota</p>
        </div>
      </div>
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
      </nav>
      <button id="menu-btn" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
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
      </div>
    </nav>
  </div>
</header>

<main class="max-w-4xl mx-auto px-6 py-10 w-full flex-grow">
  <div class="bg-white shadow-lg rounded-2xl p-8">
    <!-- Alertas -->
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

    {{-- ALERTA DE VENCIMIENTO DE SOAT Y TÉCNICO MECÁNICA --}}
    @php
      use Carbon\Carbon;
      $hoy = Carbon::now();
      $diasSoat = null;
      $diasTecnico = null;
      $fechaVencSoat = old('soat_vencimiento') ? Carbon::parse(old('soat_vencimiento')) : null;
      $fechaVencTecnico = old('tecnico_vencimiento') ? Carbon::parse(old('tecnico_vencimiento')) : null;
      if($fechaVencSoat) $diasSoat = $hoy->diffInDays($fechaVencSoat, false);
      if($fechaVencTecnico) $diasTecnico = $hoy->diffInDays($fechaVencTecnico, false);
    @endphp

    @if($diasSoat !== null && $diasSoat <= 15 && $diasSoat >= 0)
      <div class="max-w-md mx-auto mb-4 mt-8">
        <div class="flex items-center bg-red-100 border-l-4 border-red-500 p-4 rounded-lg shadow">
          <i class="fa-solid fa-file-shield text-red-600 text-2xl mr-4"></i>
          <div>
            <div class="text-lg font-semibold text-red-800">
              ¡El SOAT vence en <span class="font-bold">{{ intval(ceil($diasSoat)) }} día{{ intval(ceil($diasSoat)) == 1 ? '' : 's' }}</span>!
            </div>
            <div class="text-sm text-red-700">
              Fecha de vencimiento: {{ $fechaVencSoat->format('d/m/Y') }}
            </div>
          </div>
        </div>
      </div>
    @endif

    @if($diasTecnico !== null && $diasTecnico <= 15 && $diasTecnico >= 0)
      <div class="max-w-md mx-auto mb-4 mt-8">
        <div class="flex items-center bg-red-100 border-l-4 border-red-500 p-4 rounded-lg shadow">
          <i class="fa-solid fa-file-contract text-red-600 text-2xl mr-4"></i>
          <div>
            <div class="text-lg font-semibold text-red-800">
              ¡La técnico mecánica vence en <span class="font-bold">{{ intval(ceil($diasTecnico)) }} día{{ intval(ceil($diasTecnico)) == 1 ? '' : 's' }}</span>!
            </div>
            <div class="text-sm text-red-700">
              Fecha de vencimiento: {{ $fechaVencTecnico->format('d/m/Y') }}
            </div>
          </div>
        </div>
      </div>
    @endif

    <form action="{{ route('vehiculos.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8" novalidate>
      @csrf

      <!-- Formulario principal -->
      <div class="lg:col-span-2 space-y-6">
        <div class="form-group">
          <label for="placa" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-id-card mr-2 text-gray-400"></i>Placa
          </label>
          <input
            type="text"
            id="placa"
            name="placa"
            class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
            autocomplete="off"
            value="{{ old('placa') }}"
            placeholder="Ej: ABC123"
          />
          @error('placa')
            <p class="text-red-600 mt-2 text-sm flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div class="form-group">
          <label for="tipo" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-tag mr-2 text-gray-400"></i>Tipo
          </label>
          <input
            type="text"
            id="tipo"
            name="tipo"
            class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
            autocomplete="off"
            value="{{ old('tipo') }}"
            placeholder="Ej: Camión, Furgón, etc."
          />
          @error('tipo')
            <p class="text-red-600 mt-2 text-sm flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div class="form-group">
          <label for="marca" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-industry mr-2 text-gray-400"></i>Marca
          </label>
          <input
            type="text"
            id="marca"
            name="marca"
            class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            autocomplete="off"
            value="{{ old('marca') }}"
            placeholder="Ej: Chevrolet, Renault, etc."
          />
          @error('marca')
            <p class="text-red-600 mt-2 text-sm flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div class="form-group">
          <label for="modelo" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-car-side mr-2 text-gray-400"></i>Modelo
          </label>
          <input
            type="text"
            id="modelo"
            name="modelo"
            class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            autocomplete="off"
            value="{{ old('modelo') }}"
            placeholder="Ej: 2020"
          />
          @error('modelo')
            <p class="text-red-600 mt-2 text-sm flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div class="form-group">
          <label for="user_id" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-user-tie mr-2 text-gray-400"></i>Conductor asignado (opcional)
          </label>
          <select
            id="user_id"
            name="user_id"
            class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
            <option value="">Sin asignar</option>
            @foreach($conductores as $conductor)
              <option
                value="{{ $conductor->id }}"
                {{ old('user_id') == $conductor->id ? 'selected' : '' }}
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

        <div class="form-group">
          <label for="soat_pdf" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-file-shield mr-2 text-gray-400"></i>SOAT (PDF)
          </label>
          <input type="file" id="soat_pdf" name="soat_pdf" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          @error('soat_pdf')
            <p class="text-red-600 mt-2 text-sm flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>
        <div class="form-group">
          <label for="tecnico_pdf" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-file-contract mr-2 text-gray-400"></i>Técnico Mecánica (PDF)
          </label>
          <input type="file" id="tecnico_pdf" name="tecnico_pdf" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          @error('tecnico_pdf')
            <p class="text-red-600 mt-2 text-sm flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>
        <div class="form-group">
          <label for="licencia_transito_pdf" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
            <i class="fas fa-id-card mr-2 text-gray-400"></i>Licencia de Tránsito (PDF)
          </label>
          <input type="file" id="licencia_transito_pdf" name="licencia_transito_pdf" accept="application/pdf" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          @error('licencia_transito_pdf')
            <p class="text-red-600 mt-2 text-sm flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="soat_expedicion" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-calendar-plus mr-2 text-gray-400"></i>Expedición SOAT
            </label>
            <input type="date" id="soat_expedicion" name="soat_expedicion" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('soat_expedicion') }}" />
            @error('soat_expedicion')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>
          <div>
            <label for="soat_vencimiento" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-calendar-times mr-2 text-gray-400"></i>Vencimiento SOAT
            </label>
            <input type="date" id="soat_vencimiento" name="soat_vencimiento" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('soat_vencimiento') }}" />
            @error('soat_vencimiento')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>
        </div>
        <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tecnico_expedicion" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-calendar-plus mr-2 text-gray-400"></i>Expedición Técnico Mecánica
            </label>
            <input type="date" id="tecnico_expedicion" name="tecnico_expedicion" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('tecnico_expedicion') }}" />
            @error('tecnico_expedicion')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>
          <div>
            <label for="tecnico_vencimiento" class="form-label block text-sm font-semibold text-gray-700 mb-2 transition-colors">
              <i class="fas fa-calendar-times mr-2 text-gray-400"></i>Vencimiento Técnico Mecánica
            </label>
            <input type="date" id="tecnico_vencimiento" name="tecnico_vencimiento" class="form-input w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('tecnico_vencimiento') }}" />
            @error('tecnico_vencimiento')
              <p class="text-red-600 mt-2 text-sm flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
              </p>
            @enderror
          </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
          <button
            type="submit"
            class="submit-btn flex-1 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
          >
            <i class="fas fa-save mr-2"></i>
            Guardar Vehículo
          </button>
          <a
            href="{{ route('vehiculos.index') }}"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-xl text-center transition-all duration-300 transform hover:-translate-y-1"
          >
            <i class="fas fa-times mr-2"></i>
            Cancelar
          </a>
        </div>
      </div>

      <!-- Panel lateral -->
      <div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 slide-up" style="animation-delay: 0.1s">
          <div class="flex items-center space-x-3 mb-4">
            <div class="p-2 bg-purple-100 rounded-lg">
              <i class="fas fa-eye text-purple-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Vista Previa</h3>
          </div>
          <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
              <span class="text-white font-bold text-2xl" id="preview-placa">XX</span>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 mb-1" id="preview-placa-full">Placa</h4>
            <p class="text-gray-600 mb-2" id="preview-tipo">Tipo</p>
            <div class="mb-2">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-blue-100 text-blue-800 border-blue-200" id="preview-marca">
                <i class="fas fa-industry mr-1"></i>
                Sin marca
              </span>
            </div>
            <div>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-green-100 text-green-800 border-green-200" id="preview-modelo">
                <i class="fas fa-car-side mr-1"></i>
                Sin modelo
              </span>
            </div>
            <div class="mt-4">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-gray-100 text-gray-800 border-gray-200" id="preview-conductor">
                <i class="fas fa-user-tie mr-1"></i>
                Sin conductor
              </span>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 p-6 slide-up mt-6" style="animation-delay: 0.2s">
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
    </form>
  </div>
</main>

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