<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class HomeController extends Controller
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke()
    {
        $header = null;

        if(env('APP_ENV') != 'local') {
            $header = $this->client->get(env('APP_SITE_DOMAIN') . '/bitrix/header.php')
                ->getBody()->getContents();
        }

        view('app', compact('header'));
    }
}
