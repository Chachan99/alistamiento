<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Nuevo Ítem | Transporte S.A.</title>
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
<body class="bg-gray-50 min-h-screen flex flex-col">

<!-- Header -->
<header class="glass-effect sticky top-0 z-50 border-b border-white/20 shadow-lg">
    <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="gradient-bg p-3 rounded-xl shadow-lg">
                <i class="fas fa-clipboard-list text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Nuevo Ítem del Checklist</h1>
                <p class="text-sm text-gray-500">Agrega un nuevo ítem al checklist de alistamiento</p>
            </div>
        </div>
        <a href="{{ route('checklist.index') }}" class="nav-link text-indigo-700 font-semibold hover:text-indigo-900 transition px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
    </div>
</header>

<main class="flex-grow max-w-2xl mx-auto px-6 py-10 w-full">
    <div class="bg-white shadow-lg rounded-2xl p-8 fade-in">
        @if ($errors->any())
            <div class="mb-6 rounded-lg border-l-4 border-red-500 bg-red-100 p-4 flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                <span class="font-medium text-red-800">
                    Corrige los siguientes errores:
                    <ul class="list-disc ml-6 mt-2 text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>
            </div>
        @endif

        <form action="{{ route('checklist.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-indigo-700 font-semibold mb-2" for="nombre">Nombre del ítem</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50"
                    placeholder="Ej: Luces, Frenos, Aceite..."
                >
            </div>
            <div>
                <label class="block text-indigo-700 font-semibold mb-2" for="activo">Estado</label>
                <select
                    id="activo"
                    name="activo"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50"
                >
                    <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition">
                    <i class="fas fa-save mr-2"></i>Guardar
                </button>
                <a href="{{ route('checklist.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-xl text-center transition">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
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
</body>
</html>