<?php

namespace App\Providers;

use App\Models\Litter;
use App\Models\Station;
use App\Policies\LitterPolicy;
use App\Policies\StationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    }
}
