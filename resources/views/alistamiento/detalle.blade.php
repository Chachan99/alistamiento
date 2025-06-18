<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalle de Alistamiento | Transporte S.A.</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f9fafb;
    }
    .glass-effect {
      backdrop-filter: blur(10px);
      background: rgba(255,255,255,0.95);
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
  </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

  <!-- Header con efecto glassmorphism -->
  <header class="glass-effect sticky top-0 z-30 border-b border-white/20 shadow-lg">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <div class="gradient-bg p-3 rounded-xl shadow-lg">
          <i class="fas fa-info-circle text-white text-xl"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Detalle de Alistamiento</h1>
          <p class="text-sm text-gray-500">Información y validación del registro</p>
        </div>
      </div>
      <div class="flex items-center gap-4">
        <nav class="hidden md:flex space-x-6 text-indigo-700 font-semibold">
          <a href="{{ route('alistamientos.verificar') }}" class="nav-link hover:text-indigo-900 transition">Inicio</a>
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
      <a href="{{ route('alistamientos.verificar') }}" class="block text-indigo-700 font-semibold hover:text-indigo-900 transition">Inicio</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
          type="submit"
          class="w-full text-left text-red-600 font-semibold hover:text-red-800 transition flex items-center gap-1"
          aria-label="Cerrar sesión"
        >
          <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </button>
      </form>
    </nav>
  </header>

  <main class="flex-grow max-w-4xl mx-auto px-6 py-10 w-full">

    <!-- DATOS DEL CONDUCTOR (AHORA ARRIBA Y CON LOS DATOS DEL CONDUCTOR DEL ALISTAMIENTO) -->
    <div class="max-w-3xl mx-auto mb-8">
      <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg p-8 flex flex-col md:flex-row items-center gap-8">
        <div>
          <div class="w-32 h-32 rounded-full bg-white shadow flex items-center justify-center overflow-hidden mb-4">
            <i class="fa-solid fa-user text-6xl text-blue-400"></i>
          </div>
          <h2 class="text-2xl font-bold text-white mb-1">{{ $alistamiento->conductor->name }}</h2>
          <p class="text-white/80 mb-2"><i class="fa-solid fa-envelope mr-2"></i>{{ $alistamiento->conductor->email }}</p>
          <p class="text-white/80 mb-2"><i class="fa-solid fa-id-card mr-2"></i>Cédula: {{ $alistamiento->conductor->numero_cedula ?? 'No registrada' }}</p>
        </div>
        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="bg-white rounded-lg p-4 shadow">
            <h3 class="font-semibold text-blue-600 mb-2">Licencia de Conducción</h3>
            <p><b>Expedición:</b> {{ $alistamiento->conductor->fecha_expedicion_licencia ? \Carbon\Carbon::parse($alistamiento->conductor->fecha_expedicion_licencia)->format('d/m/Y') : 'No registrada' }}</p>
            <p><b>Vencimiento:</b> {{ $alistamiento->conductor->fecha_vencimiento_licencia ? \Carbon\Carbon::parse($alistamiento->conductor->fecha_vencimiento_licencia)->format('d/m/Y') : 'No registrada' }}</p>
            @if($alistamiento->conductor->pdf_licencia)
              <a href="{{ asset('storage/' . $alistamiento->conductor->pdf_licencia) }}" target="_blank" class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                <i class="fa-solid fa-file-pdf mr-1"></i>Ver PDF Licencia
              </a>
            @else
              <span class="inline-block mt-2 px-3 py-1 bg-gray-100 text-gray-500 rounded">Sin archivo</span>
            @endif
          </div>
          <div class="bg-white rounded-lg p-4 shadow">
            <h3 class="font-semibold text-blue-600 mb-2">Cédula</h3>
            <p><b>Número:</b> {{ $alistamiento->conductor->numero_cedula ?? 'No registrada' }}</p>
            @if($alistamiento->conductor->pdf_cedula)
              <a href="{{ asset('storage/' . $alistamiento->conductor->pdf_cedula) }}" target="_blank" class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                <i class="fa-solid fa-file-pdf mr-1"></i>Ver PDF Cédula
              </a>
            @else
              <span class="inline-block mt-2 px-3 py-1 bg-gray-100 text-gray-500 rounded">Sin archivo</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-8 space-y-8 fade-in">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <span class="text-indigo-800 font-bold"><i class="fas fa-user mr-1"></i>Conductor:</span>
          <span class="text-gray-800">{{ $alistamiento->conductor->name }}</span>
        </div>
        <div>
          <span class="text-indigo-800 font-bold"><i class="fas fa-car mr-1"></i>Vehículo:</span>
          <span class="text-gray-800">{{ $alistamiento->vehiculo->placa }}</span>
        </div>
        <div>
          <span class="text-indigo-800 font-bold"><i class="fas fa-calendar-alt mr-1"></i>Fecha:</span>
          <span class="text-gray-800">{{ $alistamiento->created_at->format('d/m/Y H:i') }}</span>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-indigo-700 font-semibold mb-2 flex items-center gap-2"><i class="fas fa-list-check"></i> Checklist</h3>
          <ul class="list-disc ml-6 space-y-1">
            @foreach($alistamiento->checklist as $item => $respuesta)
              <li><strong>{{ ucfirst($item) }}:</strong> {{ ucfirst($respuesta) }}</li>
            @endforeach
          </ul>
        </div>
        <div>
          <h3 class="text-indigo-700 font-semibold mb-2 flex items-center gap-2"><i class="fas fa-comment-dots"></i> Observaciones</h3>
          <p class="text-gray-700">{{ $alistamiento->observaciones ?? 'Ninguna' }}</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-indigo-700 font-semibold mb-2 flex items-center gap-2"><i class="fas fa-file-image"></i> Foto cargada por el conductor</h3>
          @if($alistamiento->foto_danio)
            <img src="{{ asset('storage/' . $alistamiento->foto_danio) }}" alt="Foto del daño en el vehículo {{ $alistamiento->vehiculo->placa }}" class="w-full max-w-xs rounded shadow object-cover border border-gray-200" loading="lazy" />
            <a href="{{ asset('storage/' . $alistamiento->foto_danio) }}" target="_blank" class="block mt-2 text-blue-600 hover:underline text-sm"><i class="fas fa-external-link-alt"></i> Ver imagen completa</a>
          @else
            <span class="text-gray-500">No se cargó foto</span>
          @endif
        </div>
        <div>
          <h3 class="text-indigo-700 font-semibold mb-2 flex items-center gap-2"><i class="fas fa-history"></i> Historial de acciones</h3>
          <ul class="list-disc ml-6 space-y-1 text-gray-700">
            <li><strong>Estado actual:</strong> <span class="font-bold {{ $alistamiento->estado == 'aprobado' ? 'text-green-600' : ($alistamiento->estado == 'rechazado' ? 'text-red-600' : 'text-yellow-600') }}">{{ ucfirst($alistamiento->estado) }}</span></li>
            <li><strong>Creado:</strong> {{ $alistamiento->created_at->format('d/m/Y H:i') }}</li>
            @if($alistamiento->updated_at && $alistamiento->updated_at != $alistamiento->created_at)
              <li><strong>Última actualización:</strong> {{ $alistamiento->updated_at->format('d/m/Y H:i') }}</li>
            @endif
            @if($alistamiento->estado == 'rechazado' && $alistamiento->observaciones)
              <li><strong>Motivo de rechazo:</strong> <span class="text-red-700">{{ $alistamiento->observaciones }}</span></li>
            @endif
          </ul>
        </div>
      </div>

      <div class="flex flex-col md:flex-row gap-6 mt-8">
        <form method="POST" action="{{ route('alistamientos.aprobar', $alistamiento->id) }}" class="flex-1">
          @csrf
          <button type="submit" class="w-full bg-green-600 hover:bg-green-800 text-white px-4 py-3 rounded font-semibold shadow transition"><i class="fas fa-check mr-2"></i> Aprobar</button>
        </form>
        <form method="POST" action="{{ route('alistamientos.rechazar', $alistamiento->id) }}" class="flex-1 flex flex-col gap-2">
          @csrf
          <textarea name="observaciones" required placeholder="Motivo del rechazo..." class="border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-red-500" rows="3"></textarea>
          <button type="submit" class="w-full bg-red-600 hover:bg-red-800 text-white px-4 py-3 rounded font-semibold shadow transition"><i class="fas fa-times mr-2"></i> Rechazar</button>
        </form>
      </div>
    </div>

    <!-- Historial de Alistamientos -->
    <div class="max-w-4xl mx-auto mt-10">
      <h3 class="text-xl font-bold mb-4 text-gray-700">Historial de Alistamientos</h3>
      <div class="bg-white rounded-xl shadow p-6">
        @if($alistamientos->count())
          <table class="w-full text-left">
            <thead>
              <tr>
                <th class="py-2 px-3">Fecha</th>
                <th class="py-2 px-3">Vehículo</th>
                <th class="py-2 px-3">Estado</th>
                <th class="py-2 px-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($alistamientos as $alistamiento)
                <tr class="border-t hover:bg-blue-50 transition">
                  <td class="py-2 px-3">{{ \Carbon\Carbon::parse($alistamiento->created_at)->format('d/m/Y H:i') }}</td>
                  <td class="py-2 px-3">{{ $alistamiento->vehiculo->placa ?? 'N/A' }}</td>
                  <td class="py-2 px-3">
                    <span class="px-2 py-1 rounded text-xs {{ $alistamiento->estado == 'Aprobado' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                      {{ $alistamiento->estado }}
                    </span>
                  </td>
                  <td class="py-2 px-3">
                    <a href="{{ route('alistamientos.detalle', $alistamiento) }}" class="text-blue-600 hover:underline">Ver detalles</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p class="text-gray-500">No hay alistamientos registrados.</p>
        @endif
      </div>
    </div>
  </main>

  <footer class="bg-white border-t border-gray-200 py-6 mt-12">
    <div class="max-w-7xl mx-auto px-6 text-center text-gray-600 text-sm select-none">
      © 2024 Transporte S.A. Todos los derechos reservados.
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