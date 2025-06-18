<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Conductor</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f3f4f6;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-100">
  <header class="bg-white shadow sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
      <h1 class="text-3xl font-extrabold text-indigo-900">
        Dashboard - Conductor
      </h1>
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
    </div>
  </header>

  @if(session('error'))
    <div class="max-w-7xl mx-auto px-6 mt-6">
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error:</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    </div>
  @endif

  @if(session('success'))
    <div class="max-w-7xl mx-auto px-6 mt-6">
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">¡Éxito!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    </div>
  @endif

  <main class="flex-grow py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-indigo-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-car-side text-indigo-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-indigo-900">Vehículos Asignados</h3>
          </div>
          <p class="text-4xl font-extrabold text-indigo-800">{{ $totalVehiculos ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-purple-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-clock text-purple-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-purple-900">Alistamientos Pendientes</h3>
          </div>
          <p class="text-4xl font-extrabold text-purple-800">{{ $alistamientosPendientes ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-teal-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-thumbs-up text-teal-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-teal-900">Alistamientos Aprobados</h3>
          </div>
          <p class="text-4xl font-extrabold text-teal-800">{{ $alistamientosAprobados ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-pink-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-ban text-pink-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-pink-900">Alistamientos Rechazados</h3>
          </div>
          <p class="text-4xl font-extrabold text-pink-800">
            {{ $alistamientosRechazados ?? 0 }}
          </p>
          @if(!empty($motivoRechazo))
            <p class="mt-2 text-red-700 font-semibold text-sm">
              Motivo: {{ $motivoRechazo }}
            </p>
          @endif
        </div>

      </div>

      <div class="mt-10 bg-white p-6 rounded-lg shadow flex flex-col items-center gap-4">
        <p class="text-center text-gray-700 text-lg">
          Bienvenido, {{ auth()->user()->name }}. Aquí puedes ver el estado de tus vehículos y alistamientos.
        </p>
        <a href="{{ route('alistamiento.create') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded shadow transition"
        >
          <i class="fas fa-clipboard-check mr-2"></i> Hacer Alistamiento
        </a>
      </div>

      <!-- Bloque de datos del conductor y vehículo asignado -->
      <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Datos del Conductor -->
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-indigo-500">
          <h2 class="text-xl font-bold text-indigo-800 mb-4 flex items-center gap-2">
            <i class="fas fa-user-circle text-indigo-500"></i> Datos del Conductor
          </h2>
          <ul class="text-gray-700 space-y-2">
            <li><span class="font-semibold">Nombre:</span> {{ auth()->user()->name }}</li>
            <li><span class="font-semibold">Correo:</span> {{ auth()->user()->email }}</li>
            <li><span class="font-semibold">Número de Cédula:</span> {{ auth()->user()->numero_cedula ?? 'No registrado' }}</li>
            <li>
              <span class="font-semibold">PDF Cédula:</span>
              @if(auth()->user()->pdf_cedula)
                <a href="{{ asset('storage/' . auth()->user()->pdf_cedula) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a>
              @else
                <span class="text-gray-400">No cargado</span>
              @endif
            </li>
            <li>
              <span class="font-semibold">PDF Licencia:</span>
              @if(auth()->user()->pdf_licencia)
                <a href="{{ asset('storage/' . auth()->user()->pdf_licencia) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a>
              @else
                <span class="text-gray-400">No cargado</span>
              @endif
            </li>
            <li><span class="font-semibold">Fecha Expedición Licencia:</span> {{ auth()->user()->fecha_expedicion_licencia ?? 'No registrada' }}</li>
            <li><span class="font-semibold">Fecha Vencimiento Licencia:</span> {{ auth()->user()->fecha_vencimiento_licencia ?? 'No registrada' }}</li>
          </ul>
        </div>

        <!-- Datos del Vehículo Asignado -->
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
          <h2 class="text-xl font-bold text-green-800 mb-4 flex items-center gap-2">
            <i class="fas fa-car text-green-500"></i> Vehículo Asignado
          </h2>
          @if($vehiculo)
            <ul class="text-gray-700 space-y-2">
              <li><span class="font-semibold">Marca:</span> {{ $vehiculo->marca }}</li>
              <li><span class="font-semibold">Línea:</span> {{ $vehiculo->linea }}</li>
              <li><span class="font-semibold">Modelo:</span> {{ $vehiculo->modelo }}</li>
              <li><span class="font-semibold">Placa:</span> {{ $vehiculo->placa }}</li>
              <li>
                <span class="font-semibold">SOAT:</span>
                @if($vehiculo->soat_pdf)
                  <a href="{{ asset('storage/' . $vehiculo->soat_pdf) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a>
                @else
                  <span class="text-gray-400">No cargado</span>
                @endif
                @if($vehiculo->soat_vencimiento)
                  @php
                    $diasSoat = \Carbon\Carbon::parse($vehiculo->soat_vencimiento)->diffInDays(now(), false);
                  @endphp
                  <span class="ml-2 px-2 py-1 rounded text-xs font-semibold {{ $diasSoat <= 15 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                    Vence: {{ \Carbon\Carbon::parse($vehiculo->soat_vencimiento)->format('d/m/Y') }}
                    ({{ $diasSoat < 0 ? 'Vencido' : $diasSoat . ' días' }})
                  </span>
                @endif
              </li>
              <li>
                <span class="font-semibold">Técnico Mecánica:</span>
                @if($vehiculo->tecnico_mecanica_pdf)
                  <a href="{{ asset('storage/' . $vehiculo->tecnico_mecanica_pdf) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a>
                @else
                  <span class="text-gray-400">No cargada</span>
                @endif
                @if($vehiculo->tecnico_mecanica_vencimiento)
                  @php
                    $diasTecno = \Carbon\Carbon::parse($vehiculo->tecnico_mecanica_vencimiento)->diffInDays(now(), false);
                  @endphp
                  <span class="ml-2 px-2 py-1 rounded text-xs font-semibold {{ $diasTecno <= 15 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                    Vence: {{ \Carbon\Carbon::parse($vehiculo->tecnico_mecanica_vencimiento)->format('d/m/Y') }}
                    ({{ $diasTecno < 0 ? 'Vencido' : $diasTecno . ' días' }})
                  </span>
                @endif
              </li>
              <li>
                <span class="font-semibold">Licencia de Tránsito:</span>
                @if($vehiculo->licencia_transito_pdf)
                  <a href="{{ asset('storage/' . $vehiculo->licencia_transito_pdf) }}" target="_blank" class="text-blue-600 underline">Ver PDF</a>
                @else
                  <span class="text-gray-400">No cargada</span>
                @endif
              </li>
            </ul>
          @else
            <p class="text-gray-500">No tienes un vehículo asignado actualmente.</p>
          @endif
        </div>
      </div>
      <!-- Fin bloque datos conductor y vehículo -->

    </div>
  </main>

  <footer class="bg-white border-t border-gray-200 py-6 mt-12">
    <div class="max-w-7xl mx-auto px-6 text-center text-gray-600 text-sm select-none">
      © 2024 Transporte S.A. Todos los derechos reservados.
    </div>
  </footer>
</body>
</html>