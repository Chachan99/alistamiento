<html lang="es">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Iniciar sesión
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Inter', sans-serif;
        }
  </style>
 </head>
 <body class="bg-gradient-to-b from-blue-600 to-white min-h-screen flex items-center justify-center px-4">
  <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 sm:p-12">
   <div class="flex justify-center mb-8">
    <img alt="Logotipo de la empresa, un icono moderno abstracto azul y púrpura" class="w-24 h-24 object-contain" height="100" src="https://storage.googleapis.com/a1aa/image/28b3d95b-0a87-45d0-f02a-dd99ccb72699.jpg" width="100"/>
   </div>
   <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">
    Bienvenido de nuevo
   </h2>
   <p class="text-center text-gray-600 mb-8">
    Inicia sesión en tu cuenta para continuar
   </p>
   <div class="mb-4 hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" id="validation-errors" role="alert">
    <strong class="font-bold">
     ¡Error!
    </strong>
    <span class="block sm:inline" id="validation-error-text">
    </span>
   </div>
   <div class="mb-4 hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" id="session-status" role="alert">
    <span class="block sm:inline" id="session-status-text">
    </span>
   </div>
   <form action="{{ route('login') }}" class="space-y-6" method="POST" novalidate="">
    @csrf
    <div>
     <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">
      Correo electrónico
     </label>
     <div class="relative">
      <input autocomplete="username" autofocus="" class="block w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" id="email" name="email" placeholder="tucorreo@ejemplo.com" required="" type="email" value="{{ old('email') }}"/>
      <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
       <i class="fas fa-envelope">
       </i>
      </span>
     </div>
    </div>
    <div>
     <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">
      Contraseña
     </label>
     <div class="relative">
      <input autocomplete="current-password" class="block w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" id="password" name="password" placeholder="••••••••" required="" type="password"/>
      <span class="absolute inset-y-0 right-3 flex items-center text-gray-400 cursor-pointer" onclick="togglePasswordVisibility()">
       <i class="fas fa-eye" id="password-icon">
       </i>
      </span>
     </div>
    </div>
    <div class="flex items-center justify-between">
     <label class="inline-flex items-center cursor-pointer select-none" for="remember_me">
      <input class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" id="remember_me" name="remember" type="checkbox"/>
      <span class="ml-2 text-sm text-gray-700">
       Recuérdame
      </span>
     </label>
    </div>
    <button class="w-full py-3 rounded-xl bg-blue-600 text-white font-semibold text-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition" type="submit">
     Iniciar sesión
    </button>
   </form>
  </div>
  <script>
   function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
  </script>
 </body>
</html>