<?php

namespace Tests\Unit\Services\Exchange1C;

use App\Services\Exchange1C\Receiver;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use Mockery as m;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ReceiverTest extends TestCase
{
    private Client $httpClient;
    private Receiver $receiver;

    protected function setUp(): void
    {
        parent::setUp();
        $this->httpClient = m::mock(Client::class);
        $this->receiver = new Receiver('http://url.test', 'login', 'password', $this->httpClient);
    }

    public function testSuccessResponse()
    {
        $this->httpClient
            ->shouldReceive('request')
            ->andReturn($this->makeResponse(200, ['Result' => true, 'Message' => 'OK']));

        $response = $this->receiver->request('POST', '/url');
        self::assertTrue($response['Result'] == true);
        self::assertTrue($response['Message'] == 'OK');
    }

    public function testHasServerError()
    {
        $this->httpClient
            ->shouldReceive('request')
            ->andThrow(new ServerException('Timed out', new Request('POST', 'http://test.test')));

        self::expectException(\DomainException::class);
        self::expectExceptionMessage('Нет ответа от удаленного сервера');
        $this->receiver->request('POST', '/url');
    }

    public function testHasBadResponseWithResultNotTrue()
    {
        $this->httpClient
            ->shouldReceive('request')
            ->andReturn($this->makeResponse(200, ['Result' => false, 'Message' => 'Произошла ошибка']));

        self::expectException(\DomainException::class);
        self::expectExceptionMessage('Произошла ошибка');
        $this->receiver->request('POST', '/url');
    }

    private function makeResponse(int $status, array $body): Response
    {
        return new Response($status, ['Content-Type' => 'application/json'], json_encode($body));
    }
}
