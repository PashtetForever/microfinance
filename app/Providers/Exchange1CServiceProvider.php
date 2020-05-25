<?php

namespace App\Providers;

use App\Services\Exchange1C\API;
use App\Services\Exchange1C\Receiver;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class Exchange1CServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Receiver::class, function() {
            $config = config('exchange_1c');
            return new Receiver($config['baseUri'], $config['login'], $config['password']);
        });

        $this->app->singleton(API::class, function (Application $app) {
            return new API($app->make(Receiver::class));
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
