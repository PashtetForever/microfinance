<?php

namespace App\Imports;

use App\Models\Loan;
use App\Services\Exchange1C\API;
use App\UseCases\Loan\DocumentsService;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoadSignedContracts implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    use Importable;

    private API $api;
    private DocumentsService $documentsService;

    public function __construct()
    {
        $this->api = app()->get(API::class);
        $this->documentsService = app()->get(DocumentsService::class);
    }

    public function model(array $row)
    {
        $loginData = (array)$this->api->login('test', 'test')->getData(true);
        $currentLoan = (array)$this->api->getCurrentLoan($loginData['SessionId'], $row['loan_guid'])->getData(true);
        $contractSms = $currentLoan['SMS']['Contract'];
        $signContractData = $this->api->requestSignContract($loginData['SessionId'], $contractSms, $row['loan_guid']);
        $loan = Loan::whereLoanGuid($row['loan_guid'])->firstOrFail();
        $this->documentsService->addDocumentToLoan(
            $loan, $loginData['SessionId'], $signContractData['Description'], $signContractData['FileName'], $contractSms);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
