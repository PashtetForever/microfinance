<?php

namespace Feature\Services\Exchange1C;

use App\Services\Exchange1C\API;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Mock;
use Tests\TestCase;
use GuzzleHttp\Psr7\Response;

class APITest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCorrectLogin()
    {
        $mock = \Mockery::mock(API::class);
        $mock->shouldReceive('login')
            ->withAnyArgs()
            ->andReturn($this->createMockResponse(['SessionID' => 'session-id'], 200));

        $this->app->instance(API::class, $mock);

        $response = $this->post('/api/user/login', ['login' => 'test', 'password' => 'test', 'phone' => '+7 (953) 939-38-13']);
        $response->assertStatus(200);
        $response->assertJson(['SessionID' => 'session-id']);
    }

    public function testCreateLoanCorrect()
    {
        $mock = \Mockery::mock(API::class);
        $mock->shouldReceive('requestCreateLoan')
            ->withAnyArgs()
            ->andReturn($this->createMockResponse([
                'status' => 'ok',
                'GUID' => $this->faker->uuid,
                'Num' => $this->faker->numberBetween(1000, 9000)
            ], 200));

        $mock->shouldReceive('getFileList')->andReturn($this->createMockResponse([
            'FileName' => 'path-to-file',
            'Description' => 'file-name'
        ], 200));

        $this->app->instance(API::class, $mock);


    }



    private function createMockResponse($responseData, $statusCode): Response
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], json_encode($responseData));
    }
}
