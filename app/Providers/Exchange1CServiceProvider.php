<?php

namespace App\Providers;

use App\Services\Exchange1C\API;
use App\Services\Exchange1C\Receiver;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class Exchange1CServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Receiver::class, function() {
            $config = config('exchange_1c');

            $client = new Client([
                'timeout' => 60,
            ]);

            return new Receiver($config['baseUri'], $config['login'], $config['password'], $client);
        });

        $this->app->singleton(API::class, function (Application $app) {
            return new API($app->make(Receiver::class));
        });
    }
}
