<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alistamientos Pendientes</title>
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
        <i class="fas fa-tasks text-blue-700"></i>
        Alistamientos Pendientes
      </h1>

      <div class="flex items-center gap-4">

        <!-- Cerrar sesión -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            type="submit"
            class="text-red-600 font-semibold hover:text-red-800 transition"
            aria-label="Cerrar sesión"
          >
            <i class="fas fa-sign-out-alt mr-1"></i> Cerrar Sesión
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

    <!-- Menú móvil (opcional) -->
    <nav
      id="mobile-menu"
      class="md:hidden bg-white shadow-inner hidden px-6 pb-4 space-y-3"
    >
      <a href="{{ route('alistamientos.verificar') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Inicio</a>
    </nav>
  </header>

  <main class="flex-grow max-w-7xl mx-auto px-6 py-10 w-full">
    <div class="bg-white shadow-lg rounded-lg p-8">
      @if(session('success'))
        <div
          class="mb-6 rounded border-l-4 border-green-500 bg-green-100 p-4 text-green-700 font-medium"
          role="alert"
        >
          {{ session('success') }}
        </div>
      @endif

      @if($alistamientos->isEmpty())
        <p class="text-gray-600 text-center italic">No hay alistamientos pendientes.</p>
      @else
        <div class="overflow-x-auto rounded-md border border-gray-200 shadow-sm">
          <table class="min-w-full text-left text-sm text-gray-700">
            <thead class="bg-blue-100 text-blue-800 uppercase font-semibold">
              <tr>
                <th scope="col" class="py-3 px-4 rounded-tl-lg">Conductor</th>
                <th scope="col" class="py-3 px-4">Vehículo</th>
                <th scope="col" class="py-3 px-4">Fecha</th>
                <th scope="col" class="py-3 px-4 rounded-tr-lg">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($alistamientos as $alistamiento)
                <tr class="border-t hover:bg-blue-50 transition">
                  <td class="py-3 px-4 font-medium text-gray-900">{{ $alistamiento->conductor->name }}</td>
                  <td class="py-3 px-4">{{ $alistamiento->vehiculo->placa }}</td>
                  <td class="py-3 px-4">{{ $alistamiento->created_at->format('Y-m-d H:i') }}</td>
                  <td class="py-3 px-4">
                    <a
                      href="{{ route('alistamientos.detalle', $alistamiento->id) }}"
                      class="text-blue-600 hover:underline font-semibold"
                      aria-label="Ver detalle del alistamiento de {{ $alistamiento->conductor->name }} para vehículo {{ $alistamiento->vehiculo->placa }}"
                    >
                      Ver Detalle
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
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
