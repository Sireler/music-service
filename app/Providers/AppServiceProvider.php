<?php

namespace App\Providers;

use App\Helpers\ID3Parser;
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
        $this->app->bind(ID3Parser::class, function ($app) {
            return new ID3Parser($app->make('getID3'));
        });
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
