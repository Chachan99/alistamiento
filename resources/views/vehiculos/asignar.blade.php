<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-900">Asignar Conductores a Vehículos</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded">
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($vehiculos->isEmpty())
            <p>No hay vehículos sin conductor asignado.</p>
        @else
            <table class="w-full text-sm">
                <thead class="bg-blue-100 text-blue-800">
                    <tr>
                        <th class="px-4 py-2">Placa</th>
                        <th class="px-4 py-2">Tipo</th>
                        <th class="px-4 py-2">Asignar a</th>
                        <th class="px-4 py-2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiculos as $vehiculo)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $vehiculo->placa }}</td>
                            <td class="px-4 py-2">{{ $vehiculo->tipo }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('vehiculos.guardar-asignacion', $vehiculo) }}" method="POST" class="flex gap-2 items-center">
                                    @csrf
                                    <select name="user_id" class="border rounded px-2 py-1">
                                        <option value="">Seleccione</option>
                                        @foreach($conductores as $conductor)
                                            <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                                        @endforeach
                                    </select>
                            </td>
                            <td class="px-4 py-2">
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-800">Asignar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
