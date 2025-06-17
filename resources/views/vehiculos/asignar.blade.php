<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Asignar Conductores a Vehículos | Transporte S.A.</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; background: #f9fafb; }
    .glass-effect { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95);}
    .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);}
    .nav-link { position: relative; overflow: hidden;}
    .nav-link::before { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #667eea, #764ba2); transition: width 0.3s ease;}
    .nav-link:hover::before { width: 100%;}
    .fade-in { animation: fadeIn 0.6s ease-out;}
    @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

<!-- Header -->
<header class="glass-effect sticky top-0 z-50 border-b border-white/20 shadow-lg">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-4">
      <div class="gradient-bg p-3 rounded-xl shadow-lg">
        <i class="fas fa-truck text-white text-xl"></i>
      </div>
      <div>
        <h1 class="text-2xl font-bold text-gray-800">Asignar Conductores a Vehículos</h1>
        <p class="text-sm text-gray-500">Gestiona la asignación de conductores</p>
      </div>
    </div>
    <nav class="hidden md:flex space-x-6 text-indigo-700 font-semibold">
      <a href="{{ route('admin.dashboard') }}" class="nav-link hover:text-indigo-900 transition">Inicio</a>
      <a href="{{ route('admin.usuarios.index') }}" class="nav-link hover:text-indigo-900 transition">Usuarios</a>
      <a href="{{ route('vehiculos.index') }}" class="nav-link hover:text-indigo-900 transition">Vehículos</a>
      <a href="{{ route('checklist.index') }}" class="nav-link hover:text-indigo-900 transition">Checklist</a>
      <a href="{{ route('reportes.index') }}" class="nav-link hover:text-indigo-900 transition">Reportes</a>
    </nav>
    <button
      aria-label="Abrir menú"
      class="md:hidden text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      id="menu-btn"
    >
      <i class="fas fa-bars fa-lg"></i>
    </button>
  </div>
  <nav class="md:hidden bg-white shadow-inner hidden px-6 pb-4 space-y-3" id="mobile-menu">
    <a href="{{ route('admin.dashboard') }}" class="block text-indigo-700 font-semibold hover:text-indigo-900 transition">Inicio</a>
    <a href="{{ route('admin.usuarios.index') }}" class="block text-indigo-700 font-semibold hover:text-indigo-900 transition">Usuarios</a>
    <a href="{{ route('vehiculos.index') }}" class="block text-indigo-700 font-semibold hover:text-indigo-900 transition">Vehículos</a>
    <a href="{{ route('checklist.index') }}" class="block text-indigo-700 font-semibold hover:text-indigo-900 transition">Checklist</a>
    <a href="{{ route('reportes.index') }}" class="block text-indigo-700 font-semibold hover:text-indigo-900 transition">Reportes</a>
  </nav>
</header>

<main class="max-w-4xl mx-auto px-6 py-10 w-full flex-grow">
  <div class="bg-white shadow-lg rounded-2xl p-8 fade-in">
    @if(session('success'))
      <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 flex items-center" role="alert">
        <i class="fas fa-check-circle text-green-400 text-lg mr-2"></i>
        <span class="text-green-800 text-sm font-medium">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:bg-green-100 rounded p-1.5">
          <i class="fas fa-times"></i>
        </button>
      </div>
    @endif

    @if($vehiculos->isEmpty())
      <div class="text-center text-gray-500 py-12">
        <i class="fas fa-info-circle text-3xl mb-2"></i>
        <p class="text-lg">No hay vehículos sin conductor asignado.</p>
      </div>
    @else
      <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-200 rounded-xl overflow-hidden">
          <thead class="bg-blue-100 text-blue-800">
            <tr>
              <th class="px-4 py-3 text-left">Placa</th>
              <th class="px-4 py-3 text-left">Tipo</th>
              <th class="px-4 py-3 text-left">Asignar a</th>
              <th class="px-4 py-3 text-left">Acción</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($vehiculos as $vehiculo)
              <tr class="border-t hover:bg-blue-50 transition">
                <td class="px-4 py-3 font-semibold text-gray-800">{{ $vehiculo->placa }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $vehiculo->tipo }}</td>
                <td class="px-4 py-3">
                  <form action="{{ route('vehiculos.guardar-asignacion', $vehiculo) }}" method="POST" class="flex gap-2 items-center">
                    @csrf
                    <select name="user_id" class="form-input border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                      <option value="">Seleccione</option>
                      @foreach($conductores as $conductor)
                        <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                      @endforeach
                    </select>
                </td>
                <td class="px-4 py-3">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                      <i class="fas fa-user-plus mr-1"></i>Asignar
                    </button>
                  </form>
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
  menuBtn?.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    const icon = menuBtn.querySelector('i');
    icon.classList.toggle('fa-bars');
    icon.classList.toggle('fa-times');
  });
</script>
</body>
</html>