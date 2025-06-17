@extends('layouts.admin')

@section('title', 'Editar Vehículo | Transporte S.A.')
@section('header_icon', 'fas fa-truck')
@section('header_title', 'Vehículos')
@section('header_subtitle', 'Edición de unidad')

@section('content')
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
@endsection
