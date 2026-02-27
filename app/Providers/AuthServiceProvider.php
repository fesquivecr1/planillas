<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('ver-usuarios', function ($user) {
            return $user->hasAnyRole(['admin', 'rrhh']);
        });

        Gate::define('crear-usuarios', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('editar-usuarios', function ($user) {
            return $user->hasAnyRole(['admin', 'rrhh']);
        });

        Gate::define('eliminar-usuarios', function ($user) {
            return $user->hasRole('admin');
        });

    }
}
