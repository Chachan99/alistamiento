<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reportes</title>
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
        <i class="fas fa-chart-bar text-blue-700"></i>
        Reportes
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
    <div class="bg-white rounded-lg shadow-lg p-8 text-center text-gray-700 text-lg font-medium">
      <i class="fas fa-hourglass-half text-yellow-500 text-4xl mb-4"></i>
      <p>Próximamente aquí estarán los reportes.</p>
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
