<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
    public function boot(): void
    {
        // Forzar HTTPS en producción (Railway)
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Definir la tasa de limitación para la generación de contenido
        RateLimiter::for('generate', function (Request $request) {
            //Si el usuario está autenticado, limitar a 10 solicitudes por minuto por ID de usuario. Si no, limitar a 5 solicitudes por minuto por dirección IP.
            return $request->user()
                ? Limit::perMinute(10)->by($request->user()->id)   // autenticado: 10/min
                : Limit::perMinute(5)->by($request->ip());          // invitado: 5/min
        });
    }
}
