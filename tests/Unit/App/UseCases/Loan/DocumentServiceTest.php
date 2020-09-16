<?php

namespace Tests\App\Services\Loan;

use App\Models\Document;
use App\Models\Loan;
use App\Services\Loan\DocumentsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentServiceTest extends TestCase
{
    use RefreshDatabase;

    private DocumentsService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app()->get(DocumentsService::class);
    }

    public function testGetContract()
    {

    }
}
