@extends('layouts.admin')

@section('title', 'Detalle Alistamiento')
@section('header_icon', 'fas fa-clipboard-check')
@section('header_title', 'Detalle de Alistamiento')
@section('header_subtitle', 'Información general')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-8 space-y-6">
      <div>
        <strong class="text-blue-800">Conductor:</strong> {{ $alistamiento->conductor->name }}
      </div>
      <div>
        <strong class="text-blue-800">Vehículo:</strong> {{ $alistamiento->vehiculo->placa }}
      </div>
      <div>
        <strong class="text-blue-800">Fecha:</strong> {{ $alistamiento->created_at->format('Y-m-d H:i') }}
      </div>

      <div>
        <h3 class="text-blue-700 font-semibold mb-2">Checklist</h3>
        <ul class="list-disc ml-6 space-y-1">
          @foreach($alistamiento->checklist as $item => $respuesta)
            <li><strong>{{ ucfirst($item) }}:</strong> {{ ucfirst($respuesta) }}</li>
          @endforeach
        </ul>
      </div>

      <div>
        <h3 class="text-blue-700 font-semibold mb-2">Observaciones del Conductor</h3>
        <p class="text-gray-700">{{ $alistamiento->observaciones ?? 'Ninguna' }}</p>
      </div>

      @if($alistamiento->foto_danio)
      <div>
        <h3 class="text-blue-700 font-semibold mb-2">Foto del Daño</h3>
        <img
          src="{{ asset('storage/' . $alistamiento->foto_danio) }}"
          alt="Foto del daño en el vehículo {{ $alistamiento->vehiculo->placa }}"
          class="w-64 rounded shadow object-cover"
          loading="lazy"
        />
      </div>
      @endif

      <div class="flex flex-col md:flex-row gap-6 mt-6">
        <form method="POST" action="{{ route('alistamientos.aprobar', $alistamiento->id) }}" class="flex-1">
          @csrf
          <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-800 text-white px-4 py-3 rounded font-semibold shadow transition"
          >
            Aprobar
          </button>
        </form>

        <form method="POST" action="{{ route('alistamientos.rechazar', $alistamiento->id) }}" class="flex-1 flex flex-col gap-2">
          @csrf
          <textarea
            name="observaciones"
            required
            placeholder="Motivo del rechazo..."
            class="border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-red-500"
            rows="3"
          ></textarea>
          <button
            type="submit"
            class="w-full bg-red-600 hover:bg-red-800 text-white px-4 py-3 rounded font-semibold shadow transition"
          >
            Rechazar
          </button>
        </form>
      </div>
    </div>
@endsection
