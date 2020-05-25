<?php

namespace App\Providers;

use App\Services\SendSms\IqSms;
use App\Services\SendSms\Sender;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Sender::class, function ($app) {
            $config = config('sms');
            return new IqSms($config['login'], $config['password'], $config['senderName']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
