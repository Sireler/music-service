<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use getID3;

class getID3ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(getID3::class, function ($app) {
            return new getID3();
        });
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
