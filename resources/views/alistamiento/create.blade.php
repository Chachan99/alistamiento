<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alistamiento - {{ $vehiculo->placa }}</title>
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
    .fade-in { animation: fadeIn 0.6s ease-out;}
    .slide-up { animation: slideUp 0.5s ease-out;}
    @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

  <!-- Header con efecto glassmorphism -->
  <header class="glass-effect sticky top-0 z-30 border-b border-white/20 shadow-lg">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <div class="gradient-bg p-3 rounded-xl shadow-lg">
          <i class="fas fa-clipboard-check text-white text-xl"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Alistamiento - {{ $vehiculo->placa }}</h1>
          <p class="text-sm text-gray-500">Checklist y registro de novedades</p>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <nav class="hidden md:flex space-x-6 text-indigo-700 font-semibold">
          <a href="{{ route('dashboard') }}" class="nav-link hover:text-indigo-900 transition">Inicio</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            type="submit"
            class="text-red-600 font-semibold hover:text-red-800 transition flex items-center gap-1"
            aria-label="Cerrar sesión"
          >
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
          </button>
        </form>
        <button
          aria-label="Abrir menú"
          class="md:hidden text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          id="menu-btn"
        >
          <i class="fas fa-bars fa-lg"></i>
        </button>
      </div>
    </div>
    <nav class="md:hidden bg-white shadow-inner hidden px-6 pb-4 space-y-3" id="mobile-menu">
      <a href="{{ route('dashboard') }}" class="block text-indigo-700 font-semibold hover:text-indigo-900 transition">Inicio</a>
    </nav>
  </header>

  <main class="flex-grow max-w-4xl mx-auto px-6 py-10 w-full">
    <div class="bg-white shadow-lg rounded-2xl p-8 fade-in">

      {{-- Mensajes flash --}}
      @if(session('success'))
        <div class="mb-6 rounded-lg border-l-4 border-green-500 bg-green-100 p-4 flex items-center">
          <i class="fas fa-check-circle text-green-500 mr-2"></i>
          <span class="font-medium text-green-800">{{ session('success') }}</span>
          <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:bg-green-200 rounded p-1.5">
            <i class="fas fa-times"></i>
          </button>
        </div>
      @endif

      @if(session('error'))
        <div class="mb-6 rounded-lg border-l-4 border-red-500 bg-red-100 p-4 flex items-center">
          <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
          <span class="font-medium text-red-800">{{ session('error') }}</span>
          <button onclick="this.parentElement.remove()" class="ml-auto text-red-500 hover:bg-red-200 rounded p-1.5">
            <i class="fas fa-times"></i>
          </button>
        </div>
      @endif

      <!-- Información del conductor -->
      <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl shadow p-6 mb-10 flex flex-col md:flex-row items-center gap-8">
        <div class="flex items-center gap-4">
          <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center shadow-lg">
            <i class="fas fa-user-tie text-white text-3xl"></i>
          </div>
          <div>
            <h2 class="text-xl font-bold text-indigo-900 mb-1">Conductor: {{ auth()->user()->name }}</h2>
            <p class="text-gray-700 text-base mb-1"><i class="fas fa-envelope text-indigo-400 mr-1"></i> {{ auth()->user()->email }}</p>
            <p class="text-gray-700 text-base mb-1"><i class="fas fa-id-card text-indigo-400 mr-1"></i> Cédula: {{ auth()->user()->numero_cedula ?? 'No registrada' }}</p>
            <p class="text-gray-700 text-base mb-1"><i class="fas fa-calendar-alt text-indigo-400 mr-1"></i> Expedición Licencia: {{ auth()->user()->fecha_expedicion_licencia ? \Carbon\Carbon::parse(auth()->user()->fecha_expedicion_licencia)->format('d/m/Y') : 'No registrada' }}</p>
            <p class="text-gray-700 text-base mb-1"><i class="fas fa-calendar-check text-indigo-400 mr-1"></i> Vencimiento Licencia: {{ auth()->user()->fecha_vencimiento_licencia ? \Carbon\Carbon::parse(auth()->user()->fecha_vencimiento_licencia)->format('d/m/Y') : 'No registrada' }}</p>
          </div>
        </div>
        <div class="flex flex-col gap-3 w-full md:w-auto">
          <div>
            <span class="text-gray-600 font-semibold flex items-center gap-2"><i class="fas fa-file-pdf text-indigo-400"></i> PDF Cédula:</span>
            @if(auth()->user()->pdf_cedula)
              <a href="{{ asset('storage/' . auth()->user()->pdf_cedula) }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1"><i class="fas fa-external-link-alt"></i> Ver archivo</a>
            @else
              <span class="text-gray-500">No cargado</span>
            @endif
          </div>
          <div>
            <span class="text-gray-600 font-semibold flex items-center gap-2"><i class="fas fa-file-pdf text-indigo-400"></i> PDF Licencia:</span>
            @if(auth()->user()->pdf_licencia)
              <a href="{{ asset('storage/' . auth()->user()->pdf_licencia) }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1"><i class="fas fa-external-link-alt"></i> Ver archivo</a>
            @else
              <span class="text-gray-500">No cargado</span>
            @endif
          </div>
        </div>
      </div>

      <form action="{{ route('alistamiento.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- Fechas SOAT y Técnico Mecánica -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-5 shadow flex flex-col gap-2">
            <h4 class="font-bold text-blue-800 mb-2 flex items-center gap-2"><i class="fas fa-file-contract"></i> SOAT</h4>
            <label class="text-blue-700 font-semibold">Fecha de Expedición</label>
            <input type="date" name="soat_expedicion" class="form-input w-full border border-blue-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" value="{{ old('soat_expedicion') }}" required>
            <label class="text-blue-700 font-semibold mt-2">Fecha de Vencimiento</label>
            <input type="date" name="soat_vencimiento" class="form-input w-full border border-blue-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white" value="{{ old('soat_vencimiento') }}" required>
          </div>
          <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-5 shadow flex flex-col gap-2">
            <h4 class="font-bold text-green-800 mb-2 flex items-center gap-2"><i class="fas fa-tools"></i> Técnico Mecánica</h4>
            <label class="text-green-700 font-semibold">Fecha de Expedición</label>
            <input type="date" name="tecnico_expedicion" class="form-input w-full border border-green-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 bg-white" value="{{ old('tecnico_expedicion') }}" required>
            <label class="text-green-700 font-semibold mt-2">Fecha de Vencimiento</label>
            <input type="date" name="tecnico_vencimiento" class="form-input w-full border border-green-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 bg-white" value="{{ old('tecnico_vencimiento') }}" required>
          </div>
        </div>

        <div class="flex items-center mb-8">
          <div class="p-2 bg-indigo-100 rounded-lg mr-3">
            <i class="fas fa-tasks text-indigo-600"></i>
          </div>
          <h3 class="text-indigo-800 font-bold text-lg">Checklist de Alistamiento</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($itemsChecklist as $item)
          <div class="form-group">
            <label for="checklist_{{ strtolower(str_replace(' ', '_', $item->nombre)) }}" class="form-label block text-indigo-700 font-semibold mb-1">
              {{ $item->nombre }}
            </label>
            <select
              id="checklist_{{ strtolower(str_replace(' ', '_', $item->nombre)) }}"
              name="checklist[{{ strtolower($item->nombre) }}]"
              required
              class="form-input w-full border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50"
            >
              <option value="">Seleccione</option>
              <option value="si">Sí</option>
              <option value="no">No</option>
            </select>
          </div>
          @endforeach
        </div>

        <div class="mt-8">
          <label for="observaciones" class="block text-indigo-700 font-semibold mb-2">Observaciones</label>
          <textarea
            id="observaciones"
            name="observaciones"
            rows="3"
            class="form-input w-full border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50"
            placeholder="Describe cualquier novedad, daño o comentario relevante..."
          >{{ old('observaciones') }}</textarea>
        </div>

        <div class="mt-8">
          <label for="foto_danio" class="block text-indigo-700 font-semibold mb-2">Foto de daño (opcional)</label>
          <input
            type="file"
            id="foto_danio"
            name="foto_danio"
            accept="image/*"
            class="form-input w-full border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50"
          />
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200 mt-8">
          <button
            type="submit"
            class="submit-btn flex-1 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-indigo-600 hover:bg-indigo-700"
          >
            <i class="fas fa-paper-plane mr-2"></i>
            Enviar Alistamiento
          </button>
          <a
            href="{{ url()->previous() }}"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-xl text-center transition-all duration-300 transform hover:-translate-y-1"
          >
            <i class="fas fa-arrow-left mr-2"></i>
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </main>

  <footer class="bg-white border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-8">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="flex items-center space-x-4 mb-4 md:mb-0">
          <div class="gradient-bg p-2 rounded-lg">
            <i class="fas fa-clipboard-check text-white"></i>
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
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    menuBtn?.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      const icon = menuBtn.querySelector('i');
      icon.classList.toggle('fa-bars');
      icon.classList.toggle('fa-times');
    });
  </script>
</body>
</html>