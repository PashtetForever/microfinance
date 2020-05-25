<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MandarinPayService
{
    private string $login;
    private string $password;
    private Client $client;

    public function __construct($login, $password, $apiUri = 'https://secure.mandarinpay.com')
    {
        $this->login = $login;
        $this->password = $password;
        $this->client = new Client(['base_uri' => $apiUri]);
    }

    public function identify($body)
    {
        return $this->request('POST', '/api/personidentification', $body);
    }

    public function binding(string $email, string $phone)
    {
        return $this->request('POST', '/api/card-bindings', [
            'customerInfo' => [
                'email' => $email,
                'phone' => $this->phoneToMandarinFormat($phone)
            ],
            'urls' => [
                'return' => config('mandarin')['url_return_binding'],
                'callback' => config('mandarin')['url_callback_binding'],
            ]
        ]);
    }

    public function checkSmsCode($sessionId, $code)
    {
        return $this->request('PUT', '/api/personidentification/' . $sessionId, [
            'smsCode' => $code
        ]);
    }

    public function getIdentifyResult($smsId)
    {
        return $this->request('GET', '/api/personidentification/' . $smsId);
    }


    private function request($method, $urn, $body = null)
    {
        $options = [
            'auth' => [$this->login, $this->password],
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => $body,
        ];

        try {
            $response = $this->client->request($method, $urn, $options);
            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            throw new \DomainException($e->getResponse()->getBody()->getContents());
        }
    }

    private function phoneToMandarinFormat($phone)
    {
        return str_replace(['(', ')', ' ', '-'], '', $phone);
    }
}
