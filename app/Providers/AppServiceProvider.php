<?php

namespace App\Providers;

use App\Models\CompanySetting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        //
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

        $this->app->singleton('company', function () {
            return CompanySetting::first();
        });
    }
}
