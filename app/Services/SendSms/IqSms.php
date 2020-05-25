<?php


namespace App\Services\SendSms;


use GuzzleHttp\Client;

class IqSms implements Sender
{
    private string $login;
    private string $password;
    private string $senderName;
    private Client $httpClient;

    public function __construct(string $login, string $password, string $senderName)
    {
        $this->login = $login;
        $this->password = $password;
        $this->senderName = $senderName;

        $this->httpClient = new Client();
    }

    public function send($phone, $text)
    {
        return $this->httpClient->request('GET', 'https://api.iqsms.ru/messages/v2/send', [
            'auth' => [$this->login, $this->password],
            'query' => [
                'phone' => $phone,
                'text' => $text,
                'sender' => $this->senderName
            ],
        ]);
    }
}
