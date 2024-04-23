<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    //Cambia las rutas generadas para que salgan en español
    public function boot(): void
    {
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);
    }
}
