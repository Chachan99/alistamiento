<?php

namespace App\Http\Controllers;

use App\Models\Alistamiento;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;

class ConductorController extends Controller
{
   public function dashboard()
{
    $userId = auth()->id();

    $totalVehiculos = Vehiculo::where('user_id', $userId)->count();
    $alistamientosPendientes = Alistamiento::where('user_id', $userId)->where('estado', 'pendiente')->count();
    $alistamientosAprobados = Alistamiento::where('user_id', $userId)->where('estado', 'aprobado')->count();
    $alistamientosRechazados = Alistamiento::where('user_id', $userId)->where('estado', 'rechazado')->count();

    // Obtener el último motivo de rechazo como texto plano
    $ultimoRechazo = Alistamiento::where('user_id', $userId)
        ->where('estado', 'rechazado')
        ->orderBy('updated_at', 'desc')
        ->first();

    $motivoRechazo = $ultimoRechazo ? $ultimoRechazo->observaciones : null;

    return view('conductores.dashboard', compact(
        'totalVehiculos',
        'alistamientosPendientes',
        'alistamientosAprobados',
        'alistamientosRechazados',
        'motivoRechazo'
    ));
}

}
