<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LedgerserviceController extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('App\Service\LedgerServiceInterface', 'App\Service\LedgerService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
