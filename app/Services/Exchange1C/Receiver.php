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
            'timeout' => 30,
        ]);
    }

    public function request($method, $urn, $data = null)
    {
        try {
            $response = $this->httpClient->request($method, $this->baseUri . $urn, [
                'auth' => [$this->login, $this->password],
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'json' => $data
            ]);
        } catch (ServerException $exception) {
            $response = $exception->getResponse();
            throw new \DomainException("Ошибка запроса на сервер. Код {$response->getStatusCode()} Ответ: {$response->getBody()->getContents()}");
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $contents = (array)json_decode($response->getBody()->getContents());

        if (Arr::exists($contents, 'Result'))
            if ($contents['Result'] != true)
                throw new \DomainException($contents['Message']);

        return $contents;
    }
}
