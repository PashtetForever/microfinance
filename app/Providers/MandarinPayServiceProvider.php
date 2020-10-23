<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use App\Services\MandarinPayService;

class MandarinPayServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MandarinPayService::class, function() {
            return new MandarinPayService(new Client(['base_uri' => 'https://secure.mandarinpay.com']));
        });
    }
}
