@extends('layouts.admin')

@section('title', 'Registrar Vehículo | Transporte S.A.')
@section('header_icon', 'fas fa-truck')
@section('header_title', 'Vehículos')
@section('header_subtitle', 'Registro de unidad')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-8">
      <form action="{{ route('vehiculos.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-6">
          <label for="placa" class="block text-blue-700 font-semibold mb-2">Placa</label>
          <input
            type="text"
            id="placa"
            name="placa"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
            autocomplete="off"
            value="{{ old('placa') }}"
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
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
            autocomplete="off"
            value="{{ old('tipo') }}"
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
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            autocomplete="off"
            value="{{ old('marca') }}"
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
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            autocomplete="off"
            value="{{ old('modelo') }}"
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
                {{ old('user_id') == $conductor->id ? 'selected' : '' }}
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
          Guardar Vehículo
        </button>
      </form>
    </div>
@endsection
