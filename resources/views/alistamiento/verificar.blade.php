@extends('layouts.admin')

@section('title', 'Verificar Alistamiento')
@section('header_icon', 'fas fa-clipboard-check')
@section('header_title', 'Verificación de Alistamiento')
@section('header_subtitle', 'Confirmar estado')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-8">
      @if(session('success'))
        <div
          class="mb-6 rounded border-l-4 border-green-500 bg-green-100 p-4 text-green-700 font-medium"
          role="alert"
        >
          {{ session('success') }}
        </div>
      @endif

      @if($alistamientos->isEmpty())
        <p class="text-gray-600 text-center italic">No hay alistamientos pendientes.</p>
      @else
        <div class="overflow-x-auto rounded-md border border-gray-200 shadow-sm">
          <table class="min-w-full text-left text-sm text-gray-700">
            <thead class="bg-blue-100 text-blue-800 uppercase font-semibold">
              <tr>
                <th scope="col" class="py-3 px-4 rounded-tl-lg">Conductor</th>
                <th scope="col" class="py-3 px-4">Vehículo</th>
                <th scope="col" class="py-3 px-4">Fecha</th>
                <th scope="col" class="py-3 px-4 rounded-tr-lg">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($alistamientos as $alistamiento)
                <tr class="border-t hover:bg-blue-50 transition">
                  <td class="py-3 px-4 font-medium text-gray-900">{{ $alistamiento->conductor->name }}</td>
                  <td class="py-3 px-4">{{ $alistamiento->vehiculo->placa }}</td>
                  <td class="py-3 px-4">{{ $alistamiento->created_at->format('Y-m-d H:i') }}</td>
                  <td class="py-3 px-4">
                    <a
                      href="{{ route('alistamientos.detalle', $alistamiento->id) }}"
                      class="text-blue-600 hover:underline font-semibold"
                      aria-label="Ver detalle del alistamiento de {{ $alistamiento->conductor->name }} para vehículo {{ $alistamiento->vehiculo->placa }}"
                    >
                      Ver Detalle
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
@endsection
