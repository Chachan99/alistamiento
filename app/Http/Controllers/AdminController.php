<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Alistamiento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalVehiculos = Vehiculo::count();
        $totalConductores = User::role('Conductor')->count();
        $totalJefes = User::role('Jefe Operativo')->count();
        $totalAdmins = User::role('Administrador')->count();

        $alistamientosPendientes = Alistamiento::where('estado', 'pendiente')->count();
        $alistamientosAprobados = Alistamiento::where('estado', 'aprobado')->count();
        $alistamientosRechazados = Alistamiento::where('estado', 'rechazado')->count();

        return view('admin.dashboard', compact(
            'totalVehiculos',
            'totalConductores',
            'totalJefes',
            'totalAdmins',
            'alistamientosPendientes',
            'alistamientosAprobados',
            'alistamientosRechazados'
        ));
    }
}
