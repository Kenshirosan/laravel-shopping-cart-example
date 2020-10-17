<?php

namespace App\Providers;

use App\Models\Address;
use App\Policies\AddressesPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Address::class => AddressesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
         $this->registerPolicies();

        Gate::define('see-admin-menu', function ($user) {
            return $user->isAdmin() === true;
        });

        Gate::define('see-employee-menu', function ($user) {
            return $user->isEmployee() === true;
        });
    }
}
