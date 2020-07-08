<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MandarinPayService
{
    private Client $client;

    public function __construct($apiUri = 'https://secure.mandarinpay.com')
    {
        $this->client = new Client(['base_uri' => $apiUri]);
    }

    public function identify($login, $body)
    {
        return $this->request($login,'POST', '/api/personidentification', $body);
    }

    public function binding($login, string $email, string $phone)
    {
        return $this->request($login, 'POST', '/api/card-bindings', [
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

    public function checkSmsCode($login, $sessionId, $code)
    {
        return $this->request($login, 'PUT', '/api/personidentification/' . $sessionId, [
            'smsCode' => $code
        ]);
    }

    public function getIdentifyResult($login, $smsId)
    {
        return $this->request($login, 'GET', '/api/personidentification/' . $smsId);
    }

    public function payment($login, $orderId, $price, $email, $returnUrl, $callbackUrl)
    {
        if($price == 0)
            return response(['error' => 'Нет суммы для списания'], 500);

        return $this->request($login, 'POST', '/api/transactions', [
            'payment' => [
                'orderId' => $orderId,
                'action' => 'pay',
                'price' => $price
            ],
            'customerInfo' => [
                'email' => $email
            ],
            'urls' => [
                'return' => $returnUrl,
                'callback' => $callbackUrl
            ]
        ]);
    }

    private function request($login, $method, $urn, $body = null)
    {
        $password = config("mandarin.user_login." . (int)$login);
        if(!$password)
            throw new \DomainException("Не найден пароль службы Mandarin");

        $options = [
            'auth' => [$login, $password],
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => $body,
        ];

        try {
            $response = $this->client->request($method, $urn, $options);
            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            \Log::error('Ошибка функции мандарина: '. $e->getResponse()->getStatusCode());
            throw new \DomainException($e->getResponse()->getBody()->getContents());
        }
    }

    private function phoneToMandarinFormat($phone)
    {
        return str_replace(['(', ')', ' ', '-'], '', $phone);
    }
}
