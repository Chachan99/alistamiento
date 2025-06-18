<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('conductor')->get();
        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $conductores = User::role('Conductor')->get();
        return view('vehiculos.create', compact('conductores'));
    
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos',
            'tipo' => 'required',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado con éxito.');
    }

    public function edit(Vehiculo $vehiculo)
    {
        $conductores = User::role('Conductor')->get();
        return view('vehiculos.edit', compact('vehiculo', 'conductores'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        \Log::info('Datos recibidos en update:', $request->all());
        \Log::info('Archivos recibidos:', [
            'soat_pdf' => $request->file('soat_pdf'),
            'tecnico_mecanica_pdf' => $request->file('tecnico_mecanica_pdf'),
            'licencia_transito_pdf' => $request->file('licencia_transito_pdf'),
        ]);
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa,' . $vehiculo->id,
            'tipo' => 'required',
            'user_id' => 'nullable|exists:users,id',
            'soat_pdf' => 'nullable|file|mimes:pdf',
            'tecnico_mecanica_pdf' => 'nullable|file|mimes:pdf',
            'licencia_transito_pdf' => 'nullable|file|mimes:pdf',
            'soat_expedicion' => 'nullable|date',
            'soat_vencimiento' => 'nullable|date',
            'tecnico_mecanica_expedicion' => 'nullable|date',
            'tecnico_mecanica_vencimiento' => 'nullable|date',
            'linea' => 'nullable|string',
        ]);

        $data = $request->all();

        // Procesar archivos PDF
        foreach(['soat_pdf', 'tecnico_mecanica_pdf', 'licencia_transito_pdf'] as $pdfField) {
            if ($request->hasFile($pdfField)) {
                $file = $request->file($pdfField);
                $path = $file->store('vehiculos', 'public');
                $data[$pdfField] = $path;
                \Log::info('Archivo guardado para ' . $pdfField . ': ' . $path);
            } else {
                unset($data[$pdfField]); // No sobreescribir si no se sube
                \Log::info('No se subió archivo para ' . $pdfField);
            }
        }

        $vehiculo->update($data);
        \Log::info('Datos finales guardados en vehiculo:', $vehiculo->toArray());

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado con éxito.');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado.');
    }

    public function asignarConductor()
{
    if (!auth()->user()->hasAnyRole(['Administrador', 'Jefe Operativo'])) {
        abort(403);
    }

    $vehiculos = Vehiculo::whereNull('user_id')->get();
    $conductores = User::role('Conductor')->get();

    return view('vehiculos.asignar', compact('vehiculos', 'conductores'));
}

public function guardarAsignacion(Request $request, Vehiculo $vehiculo)
{
    $request->validate([
        'user_id' => 'required|exists:users,id'
    ]);

    $vehiculo->user_id = $request->user_id;
    $vehiculo->save();

    return redirect()->route('vehiculos.asignar')->with('success', 'Conductor asignado correctamente.');
}
}
