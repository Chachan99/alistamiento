<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alistamiento - {{ $vehiculo->placa }}</title>
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
        <i class="fas fa-clipboard-check text-blue-700"></i>
        Alistamiento - {{ $vehiculo->placa }}
      </h1>

      <div class="flex items-center gap-4">
        <nav class="hidden md:flex space-x-6 text-blue-700 font-semibold">
          <a href="{{ route('dashboard') }}" class="hover:text-blue-900 transition">Inicio</a>
        </nav>

        <!-- Formulario de Cerrar Sesión -->
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

        <!-- Botón menú móvil -->
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
      <a href="{{ route('dashboard') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Inicio</a>
    </nav>
  </header>

  <main class="flex-grow max-w-4xl mx-auto px-6 py-10 w-full">
    <div class="bg-white shadow-lg rounded-lg p-8">

      {{-- Mensajes flash --}}
      @if(session('success'))
        <div class="mb-6 rounded border-l-4 border-green-500 bg-green-100 p-4 text-green-700 font-medium">
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="mb-6 rounded border-l-4 border-red-500 bg-red-100 p-4 text-red-700 font-medium">
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('alistamiento.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <h3 class="text-blue-800 font-bold mb-6 text-lg">Checklist</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($itemsChecklist as $item)
          <div>
            <label for="checklist_{{ strtolower(str_replace(' ', '_', $item->nombre)) }}" class="block text-blue-700 font-semibold mb-1">
              {{ $item->nombre }}
            </label>
            <select
              id="checklist_{{ strtolower(str_replace(' ', '_', $item->nombre)) }}"
              name="checklist[{{ strtolower($item->nombre) }}]"
              required
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Seleccione</option>
              <option value="si">Sí</option>
              <option value="no">No</option>
            </select>
          </div>
          @endforeach
        </div>

        <div class="mt-6">
          <label for="observaciones" class="block text-blue-700 font-semibold mb-2">Observaciones</label>
          <textarea
            id="observaciones"
            name="observaciones"
            rows="3"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          ></textarea>
        </div>

        <div class="mt-6">
          <label for="foto_danio" class="block text-blue-700 font-semibold mb-2">Foto de daño (opcional)</label>
          <input
            type="file"
            id="foto_danio"
            name="foto_danio"
            accept="image/*"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <button
          type="submit"
          class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded shadow transition"
        >
          Enviar Alistamiento
        </button>
      </form>
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
