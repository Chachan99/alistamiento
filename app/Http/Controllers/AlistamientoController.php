<?php

namespace App\Http\Controllers;

use App\Models\Alistamiento;
use App\Models\Vehiculo;
use App\Models\ItemChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlistamientoController extends Controller
{
    public function create()
    {
        $userId = Auth::id();

        $vehiculo = Vehiculo::where('user_id', $userId)->first();

        if (!$vehiculo) {
            return back()->with('error', 'No tienes un vehículo asignado.');
        }

        // Verificar si ya hizo alistamiento hoy y no mostrar el formulario si ya lo hizo
        $hoyInicio = now()->startOfDay();
        $yaAlisto = Alistamiento::where('user_id', $userId)
            ->where('created_at', '>=', $hoyInicio)
            ->exists();

        if ($yaAlisto) {
            return redirect()->route('dashboard')->with('error', 'Ya hiciste tu alistamiento del día.');
        }

        $itemsChecklist = ItemChecklist::where('activo', true)->get();

        return view('alistamiento.create', compact('vehiculo', 'itemsChecklist'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $hoyInicio = now()->startOfDay();

        // Verificar si ya hizo alistamiento hoy
        $yaAlisto = Alistamiento::where('user_id', $userId)
            ->where('created_at', '>=', $hoyInicio)
            ->exists();

        if ($yaAlisto) {
            return redirect()->route('dashboard')->with('error', 'Ya hiciste tu alistamiento del día.');
        }

        $request->validate([
            'checklist' => 'required|array',
            'foto_danio' => 'nullable|image|max:2048',
            'observaciones' => 'nullable|string',
            'soat_expedicion' => 'required|date',
            'soat_vencimiento' => 'required|date',
            'tecnico_expedicion' => 'required|date',
            'tecnico_vencimiento' => 'required|date',
        ]);

        $vehiculo = Vehiculo::where('user_id', $userId)->first();

        if (!$vehiculo) {
            return back()->with('error', 'No tienes un vehículo asignado.');
        }

        $foto = null;
        if ($request->hasFile('foto_danio')) {
            $foto = $request->file('foto_danio')->store('danios', 'public');
        }

        Alistamiento::create([
            'user_id' => $userId,
            'vehiculo_id' => $vehiculo->id,
            'checklist' => $request->input('checklist'),
            'foto_danio' => $foto,
            'observaciones' => $request->input('observaciones'),
            'soat_expedicion' => $request->input('soat_expedicion'),
            'soat_vencimiento' => $request->input('soat_vencimiento'),
            'tecnico_expedicion' => $request->input('tecnico_expedicion'),
            'tecnico_vencimiento' => $request->input('tecnico_vencimiento'),
            'estado' => 'pendiente'
        ]);

        return redirect()->route('dashboard')->with('success', 'Alistamiento enviado para revisión.');
    }

    public function verificar()
    {
        $alistamientos = Alistamiento::where('estado', 'pendiente')
            ->with(['vehiculo', 'conductor'])
            ->get();

        return view('alistamiento.verificar', compact('alistamientos'));
    }

    public function detalle($id)
{
    $alistamiento = Alistamiento::with(['vehiculo', 'conductor'])->findOrFail($id);

    // Historial de alistamientos del mismo conductor
    $alistamientos = Alistamiento::where('user_id', $alistamiento->user_id)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

    return view('alistamiento.detalle', compact('alistamiento', 'alistamientos'));
}

    public function aprobar($id)
    {
        $alistamiento = Alistamiento::findOrFail($id);
        $alistamiento->estado = 'aprobado';
        $alistamiento->save();

        return redirect()->route('alistamientos.verificar')->with('success', 'Alistamiento aprobado.');
    }

    public function rechazar(Request $request, $id)
    {
        $request->validate([
            'observaciones' => 'required|string|max:1000',
        ]);

        $alistamiento = Alistamiento::findOrFail($id);
        $alistamiento->estado = 'rechazado';
        $alistamiento->observaciones = $request->input('observaciones');
        $alistamiento->save();

        return redirect()->route('alistamientos.verificar')->with('success', 'Alistamiento rechazado.');
    }
}
