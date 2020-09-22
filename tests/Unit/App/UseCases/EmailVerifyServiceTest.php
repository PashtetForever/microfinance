<?php

namespace UseCases;

use App\Models\EmailVerify;
use App\Services\EmailVerifyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailVerifyServiceTest extends TestCase
{
    use RefreshDatabase;

    protected EmailVerifyService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app()->get(EmailVerifyService::class);
    }

    public function testVerify()
    {
        $verifyEmail = factory(EmailVerify::class)->create();
        $result = $this->service->isCorrectVerify($verifyEmail['user_guid'], $verifyEmail['code']);
        $this->assertTrue($result);

        $incorrect = $this->service->isCorrectVerify($verifyEmail['user_guid'], 111);
        $this->assertFalse($incorrect);
    }
}
