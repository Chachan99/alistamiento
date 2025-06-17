<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Vehículo</title>
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
        <i class="fas fa-truck text-blue-700"></i>
        Editar Vehículo
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

  <main class="flex-grow max-w-3xl mx-auto px-6 py-10 w-full">
    <div class="bg-white shadow-lg rounded-lg p-8">
      <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-6">
          <label for="placa" class="block text-blue-700 font-semibold mb-2">Placa</label>
          <input
            type="text"
            id="placa"
            name="placa"
            value="{{ old('placa', $vehiculo->placa) }}"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
            autocomplete="off"
          />
          @error('placa')
            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="tipo" class="block text-blue-700 font-semibold mb-2">Tipo</label>
          <input
            type="text"
            id="tipo"
            name="tipo"
            value="{{ old('tipo', $vehiculo->tipo) }}"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
            autocomplete="off"
          />
          @error('tipo')
            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="marca" class="block text-blue-700 font-semibold mb-2">Marca</label>
          <input
            type="text"
            id="marca"
            name="marca"
            value="{{ old('marca', $vehiculo->marca) }}"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            autocomplete="off"
          />
          @error('marca')
            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="modelo" class="block text-blue-700 font-semibold mb-2">Modelo</label>
          <input
            type="text"
            id="modelo"
            name="modelo"
            value="{{ old('modelo', $vehiculo->modelo) }}"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            autocomplete="off"
          />
          @error('modelo')
            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="user_id" class="block text-blue-700 font-semibold mb-2">Conductor asignado (opcional)</label>
          <select
            id="user_id"
            name="user_id"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
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
            <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
          @enderror
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded shadow transition"
        >
          Actualizar Vehículo
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
