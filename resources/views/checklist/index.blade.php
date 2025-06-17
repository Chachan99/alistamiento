@extends('layouts.admin')

@section('title', 'Checklist | Transporte S.A.')
@section('header_icon', 'fas fa-clipboard-check')
@section('header_title', 'Checklist')
@section('header_subtitle', 'Listado de Ítems')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-blue-900">Ítems del Checklist</h2>
        <a
          href="{{ route('checklist.create') }}"
          class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold shadow transition"
        >
          <i class="fas fa-plus"></i> Nuevo Ítem
        </a>
      </div>

      @if(session('success'))
      <div
        class="mb-6 rounded bg-green-100 p-4 text-green-700 font-medium"
        role="alert"
      >
        {{ session('success') }}
      </div>
      @endif

      <div class="overflow-x-auto rounded-md border border-gray-200 shadow-sm">
        <table class="w-full text-left text-sm text-gray-700">
          <thead class="bg-blue-100 text-blue-800 uppercase font-semibold">
            <tr>
              <th scope="col" class="px-4 py-3 rounded-tl-lg">Nombre</th>
              <th scope="col" class="px-4 py-3">Activo</th>
              <th scope="col" class="px-4 py-3 rounded-tr-lg">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $item)
            <tr class="border-t hover:bg-blue-50 transition">
              <td class="px-4 py-3 font-medium text-gray-900">{{ $item->nombre }}</td>
              <td class="px-4 py-3">
                @if($item->activo)
                  <span class="inline-flex items-center gap-1 text-green-600 font-semibold">
                    <i class="fas fa-check-circle"></i> Sí
                  </span>
                @else
                  <span class="inline-flex items-center gap-1 text-red-600 font-semibold">
                    <i class="fas fa-times-circle"></i> No
                  </span>
                @endif
              </td>
              <td class="px-4 py-3 flex flex-wrap gap-3">
                <a
                  href="{{ route('checklist.edit', $item) }}"
                  class="text-blue-600 hover:underline flex items-center gap-1"
                  aria-label="Editar ítem {{ $item->nombre }}"
                >
                  <i class="fas fa-edit"></i> Editar
                </a>
                <form
                  action="{{ route('checklist.destroy', $item) }}"
                  method="POST"
                  onsubmit="return confirm('¿Eliminar este ítem?');"
                  class="inline"
                >
                  @csrf
                  @method('DELETE')
                  <button
                    type="submit"
                    class="text-red-600 hover:underline flex items-center gap-1"
                    aria-label="Eliminar ítem {{ $item->nombre }}"
                  >
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="py-6 px-4 text-center text-gray-500 italic">
                No hay ítems registrados.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
@endsection
