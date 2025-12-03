<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Model::class => Policy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // --- ROLES / PERMISOS DEFINIDOS ---

        // Solo ADMIN puede gestionar Roles
        Gate::define('manage-roles', function ($user) {
            return $user->hasRole('admin');
        });

        // ADMIN + STAFF pueden gestionar usuarios
        Gate::define('manage-users', function ($user) {
            return $user->hasAnyRole(['admin', 'staff']);
        });

        // ADMIN + STAFF pueden gestionar membresías
        Gate::define('manage-membresias', function ($user) {
            return $user->hasAnyRole(['admin', 'staff']);
        });
    }
}
