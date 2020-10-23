<?php

namespace Tests\Feature\Services;

use App\Services\MandarinPayService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery as m;

class MandarinServiceTest extends TestCase
{
    use WithFaker;

    public function testSuccessIdentifyPerson()
    {
        $resultTaskId = $this->faker->uuid;
        $this->mockResponse(['ok' => $resultTaskId]);

        $response = $this->post('/api/mandarin/identify-person', [
            'mandarinLogin' => array_rand(config('mandarin.user_login')),
            'data' => [
                'lastName' => $this->faker->lastName,
                'firstName' => $this->faker->firstName,
                'patronymic' => $this->faker->name,
                'passportNumber' => $this->faker->numberBetween(1111, 9999),
                'passportSeries' => $this->faker->numberBetween(111111, 999999),
                'snils' => $this->faker->numberBetween(11111111, 99999999),
            ]
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => $resultTaskId
        ]);
    }

    public function testHasNoPasswordForMandarinUserError()
    {
        $resultTaskId = $this->faker->uuid;
        $this->mockResponse(['ok' => $resultTaskId]);

         $this->post('/api/mandarin/identify-person', [
            'mandarinLogin' => 99999,
            'data' => [
                'lastName' => $this->faker->lastName,
                'firstName' => $this->faker->firstName,
                'patronymic' => $this->faker->name,
                'passportNumber' => $this->faker->numberBetween(1111, 9999),
                'passportSeries' => $this->faker->numberBetween(111111, 999999),
                'snils' => $this->faker->numberBetween(11111111, 99999999),
            ]
        ])->withException(new \DomainException());
    }

    public function testBadResponse()
    {
        $this->mockResponse(['error' => 'error', 500]);

        $this->post('/api/mandarin/identify-person', [
            'mandarinLogin' => array_rand(config('mandarin.user_login')),
            'data' => []
        ])->withException(new \DomainException());
    }

    private function mockResponse(array $data, int $status = 200)
    {
        $client = m::mock(Client::class);
        $client->shouldReceive('request')
            ->withAnyArgs()
            ->andReturn(new Response($status, [], json_encode($data)));
        $mandarinService = new MandarinPayService($client);
        $this->instance(MandarinPayService::class, $mandarinService);
    }
}
