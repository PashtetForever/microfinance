<?php

namespace Tests\UseCases\Loan;

use App\Models\Document;
use App\Models\Loan;
use App\UseCases\Loan\LoanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class LoanServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private LoanService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app()->get(LoanService::class);
    }

    public function testAddLoan()
    {
        $loan = $this->service->addLoan($this->faker->word, $this->faker->uuid, $this->faker->uuid);
        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertInstanceOf(Collection::class, $loan->documents);
        $this->assertTrue(!$loan->documents->isEmpty());
    }

    public function testIsExistLoan()
    {
        $loan = factory(Loan::class)->create();
        $this->assertTrue($this->service->isExistLoan($loan['loan_guid']));
        $this->assertFalse($this->service->isExistLoan(221211121));
    }
}
