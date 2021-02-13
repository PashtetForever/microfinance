<?php

namespace App\Services\Exchange1C;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Arr;

class Receiver
{
    private string $baseUri;
    private string $login;
    private string $password;
    private Client $httpClient;

    public function __construct(string $baseUri, string $login, string $password, Client $httpClient)
    {
        $this->baseUri = $baseUri;
        $this->login = $login;
        $this->password = $password;
        $this->httpClient = $httpClient;
    }

    public function request($method, $urn, $data = null, $addOptions = null)
    {
        $options = [
            'auth' => [$this->login, $this->password],
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => $data,
        ];

        if($addOptions)
            array_merge($options, $addOptions);

        try {
            $response = $this->httpClient->request($method, $this->baseUri . $urn, $options);
        } catch (ServerException $exception) {
            throw new \DomainException("Нет ответа от удаленного сервера");
        }

        if(stristr($urn, '/cabinet/file/'))
            return $response->getBody()->getContents();

        $contents = (array)json_decode($response->getBody()->getContents());

        if (Arr::exists($contents, 'Result')) {
            if ($contents['Result'] != true) {
                throw new \DomainException($contents['Message']);
            }
        }

        return $contents;
    }
}
