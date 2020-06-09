<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Loan;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoansImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    use Importable;

    public function model($row)
    {
        return new Loan([
            'number' => $row['number'],
            'loan_guid' => $row['loan_guid'],
            'user_guid' => $row['user_guid']
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
