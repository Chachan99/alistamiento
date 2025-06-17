<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class RedirectAfterLogin
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event): void
    {
        $user = $event->user;

        if ($user->hasRole('Administrador')) {
            session(['url.intended' => route('admin.dashboard')]);
        } elseif ($user->hasRole('Jefe Operativo')) {
            session(['url.intended' => route('alistamientos.verificar')]);
        } elseif ($user->hasRole('Conductor')) {
            // Aquí cambiamos el nombre de la ruta al que tienes definido en routes/web.php
            session(['url.intended' => route('dashboard')]);
        }
    }
}
