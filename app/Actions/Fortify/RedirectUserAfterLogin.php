<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Auth;

class RedirectUserAfterLogin
{
    public function __invoke($request)
    {
        $user = Auth::user();

        if ($user->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('Jefe Operativo')) {
            return redirect()->route('alistamientos.verificar');
        } elseif ($user->hasRole('Conductor')) {
            return redirect()->route('alistamiento.create');
        }

        return redirect('/');
    }
}
