<?php

namespace App\Providers;

use App\Models\Litter;
use App\Models\Station;
use App\Models\User;
use App\Policies\LitterPolicy;
use App\Policies\StationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Station::class => StationPolicy::class,
        Litter::class => LitterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', static fn(User $user): bool => true); // TODO: Implements admins
    }
}
