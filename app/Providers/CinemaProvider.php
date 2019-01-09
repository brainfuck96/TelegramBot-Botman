<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Cinema;

class CinemaProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Cinema::class, function ($app) {
            return new Cinema();
        });
    }
}
