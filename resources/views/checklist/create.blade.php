<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-900">Nuevo Ítem</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded">
        <form action="{{ route('checklist.store') }}" method="POST">
            @csrf
            <label class="block text-blue-700">Nombre del ítem</label>
            <input type="text" name="nombre" required class="w-full border rounded p-2 mt-2">
            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
