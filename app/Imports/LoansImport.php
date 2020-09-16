<?php

namespace App\Imports;

use App\Services\Loan\DocumentsService;
use App\Services\Loan\LoanService;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Loan;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Services\Exchange1C\API;

class LoansImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    use Importable;

    private API $api;
    private string $sessionId;
    private DocumentsService $documentsService;

    public function __construct()
    {
        $this->api = app()->get(API::class);
        $this->documentsService = app()->get(DocumentsService::class);
        $data = (array)$this->api->login('test', 'test')->getData(true);
        $this->sessionId = $data['SessionId'];
    }

    public function model($row)
    {
        $validContractData = $this->api->getLastContractData($this->sessionId, $row['loan_guid']);
        $currentContractData = (array)$this->api->getCurrentLoan($this->sessionId, $row['loan_guid'])->getData(true);
        $smsDocuments = $currentContractData['SMS']['Agreement'];
        $smsContract = $currentContractData['SMS']['Contract'];

        $loan = Loan::create([
            'number' => $row['number'],
            'loan_guid' => $row['loan_guid'],
            'user_guid' => $row['user_guid'],
            'days' => $validContractData['Days'],
            'sum' => (int)str_replace(' ', '', $validContractData['Sum']),
            'percent' => (float)str_replace(',', '.',$validContractData['Percent'])
        ]);

        $documentsResponse = (array)$this->api->getFileList($this->sessionId, $smsDocuments, $row['loan_guid'])->getData(true);
        $documents = [];

        foreach ($documentsResponse as $document) {
            $documents[$this->documentsService->addDocumentToLoan($loan, $this->sessionId, $document['Description'], $document['FileName'], $smsDocuments)] = $document['Description'];
        }

        $contract = $this->api->getFillContract($this->sessionId, $row['loan_guid'])[0];

        $this->documentsService->addDocumentToLoan($loan, $this->sessionId, $contract->Description, $contract->FileName);

        if($smsContract) {
            $signContractFile = $this->api->requestSignContract($this->sessionId, $smsContract, $row['loan_guid']);
            $this->documentsService->addDocumentToLoan(
                $loan, $this->sessionId, $signContractFile['Description'], $signContractFile['FileName'], $smsContract);
        }

        return $loan;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
