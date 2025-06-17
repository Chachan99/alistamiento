<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ítems del Checklist</title>
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
        <i class="fas fa-clipboard-list text-blue-700"></i>
        Ítems del Checklist
      </h1>
      <nav class="hidden md:flex space-x-6 text-blue-700 font-semibold">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-900 transition">Inicio</a>
        <a href="{{ route('admin.usuarios.index') }}" class="hover:text-blue-900 transition">Usuarios</a>
        <a href="{{ route('vehiculos.index') }}" class="hover:text-blue-900 transition">Vehículos</a>
        <a href="{{ route('checklist.index') }}" class="hover:text-blue-900 transition">Checklist</a>
        <a href="{{ route('reportes.index') }}" class="hover:text-blue-900 transition">Reportes</a>
      </nav>
      <button
        aria-label="Abrir menú"
        class="md:hidden text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
        id="menu-btn"
      >
        <i class="fas fa-bars fa-lg"></i>
      </button>
    </div>
    <nav
      class="md:hidden bg-white shadow-inner hidden px-6 pb-4 space-y-3"
      id="mobile-menu"
    >
      <a href="{{ route('admin.dashboard') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Inicio</a>
      <a href="{{ route('admin.usuarios.index') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Usuarios</a>
      <a href="{{ route('vehiculos.index') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Vehículos</a>
      <a href="{{ route('checklist.index') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Checklist</a>
      <a href="{{ route('reportes.index') }}" class="block text-blue-700 font-semibold hover:text-blue-900 transition">Reportes</a>
    </nav>
  </header>

  <main class="flex-grow max-w-7xl mx-auto px-6 py-10">
    <div class="bg-white shadow-lg rounded-lg p-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-blue-900">Ítems del Checklist</h2>
        <a
          href="{{ route('checklist.create') }}"
          class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold shadow transition"
        >
          <i class="fas fa-plus"></i> Nuevo Ítem
        </a>
      </div>

      @if(session('success'))
      <div
        class="mb-6 rounded bg-green-100 p-4 text-green-700 font-medium"
        role="alert"
      >
        {{ session('success') }}
      </div>
      @endif

      <div class="overflow-x-auto rounded-md border border-gray-200 shadow-sm">
        <table class="w-full text-left text-sm text-gray-700">
          <thead class="bg-blue-100 text-blue-800 uppercase font-semibold">
            <tr>
              <th scope="col" class="px-4 py-3 rounded-tl-lg">Nombre</th>
              <th scope="col" class="px-4 py-3">Activo</th>
              <th scope="col" class="px-4 py-3 rounded-tr-lg">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $item)
            <tr class="border-t hover:bg-blue-50 transition">
              <td class="px-4 py-3 font-medium text-gray-900">{{ $item->nombre }}</td>
              <td class="px-4 py-3">
                @if($item->activo)
                  <span class="inline-flex items-center gap-1 text-green-600 font-semibold">
                    <i class="fas fa-check-circle"></i> Sí
                  </span>
                @else
                  <span class="inline-flex items-center gap-1 text-red-600 font-semibold">
                    <i class="fas fa-times-circle"></i> No
                  </span>
                @endif
              </td>
              <td class="px-4 py-3 flex flex-wrap gap-3">
                <a
                  href="{{ route('checklist.edit', $item) }}"
                  class="text-blue-600 hover:underline flex items-center gap-1"
                  aria-label="Editar ítem {{ $item->nombre }}"
                >
                  <i class="fas fa-edit"></i> Editar
                </a>
                <form
                  action="{{ route('checklist.destroy', $item) }}"
                  method="POST"
                  onsubmit="return confirm('¿Eliminar este ítem?');"
                  class="inline"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    type="submit"
                    class="text-red-600 hover:underline flex items-center gap-1"
                    aria-label="Eliminar ítem {{ $item->nombre }}"
                  >
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="py-6 px-4 text-center text-gray-500 italic">
                No hay ítems registrados.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
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
