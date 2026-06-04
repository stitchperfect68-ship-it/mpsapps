<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // super-admin bypasses all gates
        Gate::before(function ($user, $ability) {
            if ($user->role?->name === 'super-admin') {
                return true;
            }
        });

        // Register a gate for every module permission
        $permissions = [
            'access-invoicing', 'access-production', 'access-inventory',
            'access-crm', 'access-projects', 'access-ecommerce',
            'access-accounting', 'access-hr', 'access-marketing', 'access-analytics',
        ];

        foreach ($permissions as $permission) {
            Gate::define($permission, fn($user) => $user->role?->hasPermission($permission) ?? false);
        }
    }
}
