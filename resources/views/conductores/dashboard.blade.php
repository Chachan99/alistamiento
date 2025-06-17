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

    </div>
  </main>

  <footer class="bg-white border-t border-gray-200 py-6 mt-12">
    <div class="max-w-7xl mx-auto px-6 text-center text-gray-600 text-sm select-none">
      © 2024 Transporte S.A. Todos los derechos reservados.
    </div>
  </footer>
</body>
</html>