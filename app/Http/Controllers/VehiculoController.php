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
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa,' . $vehiculo->id,
            'tipo' => 'required',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $vehiculo->update($request->all());

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
