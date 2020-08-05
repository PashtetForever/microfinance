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

    public function __construct(string $baseUri, string $login, string $password)
    {
        $this->baseUri = $baseUri;
        $this->login = $login;
        $this->password = $password;
        $this->httpClient = new Client([
            'timeout' => 60,
        ]);
    }

    public function request($method, $urn, $data = null, $addOptions = null)
    {
        try {
            $options = [
                'auth' => [$this->login, $this->password],
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'json' => $data,
            ];

            if($addOptions)
                array_merge($options, $addOptions);

            $response = $this->httpClient->request($method, $this->baseUri . $urn, $options);

        } catch (ServerException $exception) {
            $response = $exception->getResponse();
            $content = $response->getBody()->getContents();
            \Log::error("Ошибка запроса на сервер.", [$content]);
            throw new \DomainException("Ошибка запроса на сервер. Код {$response->getStatusCode()} Ответ: $content");
        }
        if(stristr($urn, '/cabinet/file/'))
            return $response->getBody()->getContents();

        $contents = (array)json_decode($response->getBody()->getContents());

        if (Arr::exists($contents, 'Result'))
            if ($contents['Result'] != true) {
                \Log::error("Ошбика запроса в 1С", [
                    'urn' => $urn,
                    'result' => $contents
                ]);
                throw new \DomainException($contents['Message']);
            }

        if(Arr::exists($contents, 'error')) {
            \Log::error("Ошбика запроса в 1С", [
                'urn' => $urn,
                'result' => $contents,
                'request' => $data
            ]);
            throw new \DomainException($contents['error']);
        }

        return $contents;
    }
}
