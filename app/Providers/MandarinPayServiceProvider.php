<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MandarinPayService;

class MandarinPayServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MandarinPayService::class, function() {
            $config = config('mandarin');
            return new MandarinPayService($config['login'], $config['password']);
        });
    }
}
