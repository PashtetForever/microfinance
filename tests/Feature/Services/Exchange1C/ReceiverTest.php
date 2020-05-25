<?php

use Tests\TestCase;

class ReceiverTest extends TestCase
{
    public function testCorrectRequestWithOutResult()
    {
        $this->json('POST', '/api/user/login', ['login' => 'test', 'password' => 'test'])
            ->assertStatus(200)
            ->assertJsonStructure(['SessionId', 'GUID', 'LoanPercent']);
    }

    public function testServerErrorRequest()
    {
        $this->json('POST', '/api/user/login', ['some' => 'foo'])
            ->assertStatus(500)
            ->assertJsonStructure(['message']);
    }
    public function testIncorrectRequestWithResult()
    {
        $this->json('POST', '/api/documents/filelist', ['session_id' => 'foo'])
            ->assertStatus(500)
            ->assertJsonStructure(['message']);
    }
}
