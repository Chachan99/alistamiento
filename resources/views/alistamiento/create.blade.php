@extends('layouts.admin')

@section('title', 'Alistamiento - ' . $vehiculo->placa)
@section('header_icon', 'fas fa-clipboard-check')
@section('header_title', 'Alistamiento')
@section('header_subtitle', 'Vehículo ' . $vehiculo->placa)

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-8">

      {{-- Mensajes flash --}}
      @if(session('success'))
        <div class="mb-6 rounded border-l-4 border-green-500 bg-green-100 p-4 text-green-700 font-medium">
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="mb-6 rounded border-l-4 border-red-500 bg-red-100 p-4 text-red-700 font-medium">
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('alistamiento.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <h3 class="text-blue-800 font-bold mb-6 text-lg">Checklist</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($itemsChecklist as $item)
          <div>
            <label for="checklist_{{ strtolower(str_replace(' ', '_', $item->nombre)) }}" class="block text-blue-700 font-semibold mb-1">
              {{ $item->nombre }}
            </label>
            <select
              id="checklist_{{ strtolower(str_replace(' ', '_', $item->nombre)) }}"
              name="checklist[{{ strtolower($item->nombre) }}]"
              required
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Seleccione</option>
              <option value="si">Sí</option>
              <option value="no">No</option>
            </select>
          </div>
          @endforeach
        </div>

        <div class="mt-6">
          <label for="observaciones" class="block text-blue-700 font-semibold mb-2">Observaciones</label>
          <textarea
            id="observaciones"
            name="observaciones"
            rows="3"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          ></textarea>
        </div>

        <div class="mt-6">
          <label for="foto_danio" class="block text-blue-700 font-semibold mb-2">Foto de daño (opcional)</label>
          <input
            type="file"
            id="foto_danio"
            name="foto_danio"
            accept="image/*"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <button
          type="submit"
          class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded shadow transition"
        >
          Enviar Alistamiento
        </button>
      </form>
    </div>
@endsection
