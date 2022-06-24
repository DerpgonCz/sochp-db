<?php

namespace App\Providers;

use App\Services\Facades\FlashesFacadeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('flashes', static fn (): FlashesFacadeService => new FlashesFacadeService());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
