<?php

namespace Tests\Feature\Services;

use Tests\Feature\Generators\API\CreateLoanGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    private CreateLoanGenerator $createLoanMocks;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createLoanMocks = new CreateLoanGenerator();
    }

    public function testCreateLoanSuccess()
    {
        \Storage::fake('documents');

        $userGuid = $this->faker->uuid;
        $loanNumber = $this->faker->numberBetween(1000, 5000);
        $this->createLoanMocks->mockSuccessResponseOnCreateLoan($userGuid, $loanNumber);

        $response = $this->post('/api/loan/create', [
            'userGuid' => $userGuid,
            'sessionId' => 'session-id',
            'sum' => 6000,
            'days' => 6,
            'smsCode' => 123456
        ]);
        dd($response->getContent());
    }
}
