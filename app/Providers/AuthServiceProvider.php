<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User; 
// We no longer need the DB facade, as we are simplifying the Gate logic.
// use Illuminate\Support\Facades\DB; 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // ** CRUCIAL: Define the 'access-admin-area' Gate here **
        // The simplest, most reliable way to check the role.
        Gate::define('access-admin-area', function (User $user) {
            // Check the role directly on the authenticated User model instance.
            // This is how Laravel is designed to handle Gates.
            return $user->role === 'admin';
        });
    }
}