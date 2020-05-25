<?php


namespace Feature\Services\Exchange1C;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class APITest extends TestCase
{
    use RefreshDatabase;

    public function testLogin()
    {
        $this->post('/api/user/login', ['login' => 'test', 'password' => 'test'])
            ->assertStatus(200);
    }

    public function testCreateLoan()
    {
        $userData = $this->post('/api/user/login', ['login' => 'test', 'password' => 'test', 'phone' => '+79539393813']);
        $sessionId = $userData->json()['original']['SessionId'];
        $userGuid = $userData->json()['original']['GUID'];


    }
}
