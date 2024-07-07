<?php

// This is the service provider that instantiates the Stats class and shoves it into the service container.
// This file lives in app/Providers/StatsServiceProvider.php and was scaffolded using 'php artisan make:provider'
// This needs to be registered in config/app.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Stats;

class StatsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton( Stats::class, function () {
            return new Stats();
        });

        View::share('stats', app('App\Stats'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
