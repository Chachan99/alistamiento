<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reportes | Transporte S.A.</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; background: #f9fafb; }
    .glass-effect { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95);}
    .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);}
    .nav-link { position: relative; overflow: hidden;}
    .nav-link::before { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s;}
    .nav-link:hover::before { width: 100%;}
    .fade-in { animation: fadeIn 0.6s ease-out;}
    @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

  <!-- Header profesional -->
  <header class="glass-effect sticky top-0 z-30 border-b border-white/20 shadow-lg">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <div class="gradient-bg p-3 rounded-xl shadow-lg">
          <i class="fas fa-chart-bar text-white text-xl"></i>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Reportes</h1>
          <p class="text-sm text-gray-500">Panel de reportes y estadísticas</p>
        </div>
      </div>
      <nav class="hidden lg:flex items-center space-x-8">
        <a href="{{ route('admin.dashboard') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
          <i class="fas fa-home mr-2"></i>Dashboard
        </a>
        <a href="{{ route('admin.usuarios.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
          <i class="fas fa-users mr-2"></i>Usuarios
        </a>
        <a href="{{ route('vehiculos.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
          <i class="fas fa-truck mr-2"></i>Vehículos
        </a>
        <a href="{{ route('checklist.index') }}" class="nav-link text-gray-700 hover:text-indigo-600 font-medium px-3 py-2 transition-colors">
          <i class="fas fa-clipboard-check mr-2"></i>Checklist
        </a>
        <a href="{{ route('reportes.index') }}" class="nav-link text-indigo-600 font-semibold px-3 py-2 bg-indigo-50 rounded-lg">
          <i class="fas fa-chart-bar mr-2"></i>Reportes
        </a>
      </nav>
      <button id="menu-btn" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
    <nav id="mobile-menu" class="lg:hidden mt-4 pb-4 border-t border-gray-200 hidden">
      <div class="pt-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
          <i class="fas fa-home mr-3"></i>Dashboard
        </a>
        <a href="{{ route('admin.usuarios.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
          <i class="fas fa-users mr-3"></i>Usuarios
        </a>
        <a href="{{ route('vehiculos.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
          <i class="fas fa-truck mr-3"></i>Vehículos
        </a>
        <a href="{{ route('checklist.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
          <i class="fas fa-clipboard-check mr-3"></i>Checklist
        </a>
        <a href="{{ route('reportes.index') }}" class="flex items-center px-3 py-2 text-indigo-600 bg-indigo-50 rounded-lg font-semibold">
          <i class="fas fa-chart-bar mr-3"></i>Reportes
        </a>
      </div>
    </nav>
  </header>

  <main class="flex-grow max-w-4xl mx-auto px-6 py-16 w-full">
    <div class="bg-white rounded-2xl shadow-lg p-12 text-center text-gray-700 text-lg font-medium fade-in">
      <i class="fas fa-hourglass-half text-yellow-500 text-5xl mb-6"></i>
      <h2 class="text-2xl font-bold text-gray-900 mb-2">Próximamente</h2>
      <p class="mb-4">Aquí estarán disponibles los reportes y estadísticas del sistema.</p>
      <span class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold">
        Módulo en desarrollo
      </span>
    </div>
  </main>

  <footer class="bg-white border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-8">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="flex items-center space-x-4 mb-4 md:mb-0">
          <div class="gradient-bg p-2 rounded-lg">
            <i class="fas fa-clipboard-list text-white"></i>
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