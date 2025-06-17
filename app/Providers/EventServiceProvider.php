<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Listeners\RedirectAfterLogin;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [
    \Illuminate\Auth\Events\Login::class => [
        \App\Listeners\RedirectAfterLogin::class,
    ],
];

    

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}
