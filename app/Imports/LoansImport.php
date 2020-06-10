<?php

namespace App\Imports;

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

    public function __construct()
    {
        $this->api = app()->get(API::class);
        $data = (array)$this->api->login('test', 'test')->getData(true);
        $this->sessionId = $data['SessionId'];
    }

    public function model($row)
    {
        $loanData = $this->api->getLastContractData($this->sessionId, $row['loan_guid']);

        return new Loan([
            'number' => $row['number'],
            'loan_guid' => $row['loan_guid'],
            'user_guid' => $row['user_guid'],
            'days' => $loanData['Days'],
            'sum' => (int)str_replace(' ', '', $loanData['Sum']),
            'percent' => (float)str_replace(',', '.',$loanData['Percent'])
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
