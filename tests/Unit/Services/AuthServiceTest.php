<?php

namespace Tests\Unit\Services;

use App\Models\UserVerify;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = app()->get(AuthService::class);
    }

    public function testCorrectCheckVerifyCode()
    {
        $verifyUserRow = factory(UserVerify::class)->create([
            'phone' => '+7(111) 111-11-11'
        ]);
        $result = $this->authService->isVerifyCode($verifyUserRow['phone'], $verifyUserRow['code']);
        $this->assertTrue($result);
    }


    public function testIncorrectCheckVerifyCode()
    {
        $this->expectException(\DomainException::class);
        $this->authService->isVerifyCode('111111', '111111');
    }

    public function testCorrectPhoneToSiteFormat()
    {
        $phone = $this->authService->phoneToSiteFormat('+7(953) 939-38-13');
        $this->assertEquals('79539393813', $phone);
    }
}
