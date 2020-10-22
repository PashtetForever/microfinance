<?php

namespace Tests\Feature\API;

use App\Services\Exchange1C\Receiver;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

/**
 * @group API
 */
class ReceiverTest extends TestCase
{
    use RefreshDatabase;
    private Receiver $receiver;

    public function testSuccessResponse()
    {
        $this->receiver = app()->make(Receiver::class);
        $mock = Mockery::mock(Client::class)
            ->shouldReceive('request')
            ->andReturn(new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'Result' => true,
                'Message' => 'Yes'
            ])));

        $this->instance(Client::class, $mock);
        $response = $this->receiver->request('POST', 'some-uri', ['foo' => 'foo']);
        $this->assertEquals([
            'Result' => true,
            'Message' => 'Yes'
        ], $response);
    }

    public function testErrorResponseWithResultFalse()
    {

    }

    public function testErrorResponseWithStatusCode()
    {

    }

    private function mockResponse(array $responseData)
    {

    }
}
