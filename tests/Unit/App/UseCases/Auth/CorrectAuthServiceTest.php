<?php

namespace App\UseCases\Auth;

use App\Models\UserVerify;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CorrectAuthServiceTest extends TestCase
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
        $verifyUserRow = factory(UserVerify::class)->create();
        $result = $this->authService->checkVerifyCode($verifyUserRow['phone'], $verifyUserRow['code']);
        $this->assertInstanceOf(UserVerify::class, $result);
        $this->assertNotEmpty($result->toArray());
    }


    public function testIncorrectCheckVerifyCode()
    {
        $this->expectException(\DomainException::class);
        $this->authService->checkVerifyCode(111111, 111111);
    }

    public function testCorrectPhoneToSiteFormat()
    {
        $phone = $this->authService->phoneToSiteFormat('+7(953) 939-38-13');
        $this->assertEquals('79539393813', $phone);
    }
}
