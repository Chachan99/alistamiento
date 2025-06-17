<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalle de Alistamiento</title>
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
      background: #f9fafb;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">
  <header class="bg-white shadow sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
      <h1 class="text-2xl font-extrabold text-blue-900 flex items-center gap-2">
        <i class="fas fa-info-circle text-blue-700"></i>
        Detalle de Alistamiento
      </h1>

      <div class="flex items-center gap-6">
        <nav class="hidden md:flex space-x-6 text-blue-700 font-semibold">
          <a href="{{ route('alistamientos.verificar') }}" class="hover:text-blue-900 transition">Inicio</a>
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
          class="md:hidden text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="menu-btn"
        >
          <i class="fas fa-bars fa-lg"></i>
        </button>
      </div>
    </div>

    <nav
      class="md:hidden bg-white shadow-inner hidden px-6 pb-4 space-y-3"
      id="mobile-menu"
    >
      <a href="{{ route('alistamientos.verificar') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Inicio</a>
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
    <div class="bg-white shadow-lg rounded-lg p-8 space-y-6">
      <div>
        <strong class="text-blue-800">Conductor:</strong> {{ $alistamiento->conductor->name }}
      </div>
      <div>
        <strong class="text-blue-800">Vehículo:</strong> {{ $alistamiento->vehiculo->placa }}
      </div>
      <div>
        <strong class="text-blue-800">Fecha:</strong> {{ $alistamiento->created_at->format('Y-m-d H:i') }}
      </div>

      <div>
        <h3 class="text-blue-700 font-semibold mb-2">Checklist</h3>
        <ul class="list-disc ml-6 space-y-1">
          @foreach($alistamiento->checklist as $item => $respuesta)
            <li><strong>{{ ucfirst($item) }}:</strong> {{ ucfirst($respuesta) }}</li>
          @endforeach
        </ul>
      </div>

      <div>
        <h3 class="text-blue-700 font-semibold mb-2">Observaciones del Conductor</h3>
        <p class="text-gray-700">{{ $alistamiento->observaciones ?? 'Ninguna' }}</p>
      </div>

      @if($alistamiento->foto_danio)
      <div>
        <h3 class="text-blue-700 font-semibold mb-2">Foto del Daño</h3>
        <img
          src="{{ asset('storage/' . $alistamiento->foto_danio) }}"
          alt="Foto del daño en el vehículo {{ $alistamiento->vehiculo->placa }}"
          class="w-64 rounded shadow object-cover"
          loading="lazy"
        />
      </div>
      @endif

      <div class="flex flex-col md:flex-row gap-6 mt-6">
        <form method="POST" action="{{ route('alistamientos.aprobar', $alistamiento->id) }}" class="flex-1">
          @csrf
          <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-800 text-white px-4 py-3 rounded font-semibold shadow transition"
          >
            Aprobar
          </button>
        </form>

        <form method="POST" action="{{ route('alistamientos.rechazar', $alistamiento->id) }}" class="flex-1 flex flex-col gap-2">
          @csrf
          <textarea
            name="observaciones"
            required
            placeholder="Motivo del rechazo..."
            class="border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-red-500"
            rows="3"
          ></textarea>
          <button
            type="submit"
            class="w-full bg-red-600 hover:bg-red-800 text-white px-4 py-3 rounded font-semibold shadow transition"
          >
            Rechazar
          </button>
        </form>
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
    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
