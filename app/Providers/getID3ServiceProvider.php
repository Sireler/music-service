<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use getID3;

class getID3ServiceProvider extends ServiceProvider
{
    const TAGGING_FORMAT = 'UTF-8';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(getID3::class, function ($app) {
            $getID3 = new getID3();
            $getID3->setOption(['encoding' => self::TAGGING_FORMAT]);

            return $getID3;
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
