@extends('layouts.admin')

@section('title', 'Dashboard Conductor')
@section('header_icon', 'fas fa-id-badge')
@section('header_title', 'Panel del Conductor')
@section('header_subtitle', 'Información de rutas')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-indigo-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-car-side text-indigo-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-indigo-900">Vehículos Asignados</h3>
          </div>
          <p class="text-4xl font-extrabold text-indigo-800">{{ $totalVehiculos ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-purple-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-clock text-purple-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-purple-900">Alistamientos Pendientes</h3>
          </div>
          <p class="text-4xl font-extrabold text-purple-800">{{ $alistamientosPendientes ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-teal-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-thumbs-up text-teal-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-teal-900">Alistamientos Aprobados</h3>
          </div>
          <p class="text-4xl font-extrabold text-teal-800">{{ $alistamientosAprobados ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border-l-4 border-pink-600 hover:shadow-xl transition">
          <div class="flex items-center gap-4 mb-2">
            <i class="fas fa-ban text-pink-600 text-3xl"></i>
            <h3 class="text-lg font-semibold text-pink-900">Alistamientos Rechazados</h3>
          </div>
          <p class="text-4xl font-extrabold text-pink-800">
            {{ $alistamientosRechazados ?? 0 }}
          </p>
          @if(!empty($motivoRechazo))
            <p class="mt-2 text-red-700 font-semibold text-sm">
              Motivo: {{ $motivoRechazo }}
            </p>
          @endif
        </div>

      </div>

      <div class="mt-10 bg-white p-6 rounded-lg shadow flex flex-col items-center gap-4">
        <p class="text-center text-gray-700 text-lg">
          Bienvenido, {{ auth()->user()->name }}. Aquí puedes ver el estado de tus vehículos y alistamientos.
        </p>
        <a href="{{ route('alistamiento.create') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded shadow transition"
        >
          <i class="fas fa-clipboard-check mr-2"></i> Hacer Alistamiento
        </a>
      </div>

    </div>
@endsection
