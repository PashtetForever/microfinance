<?php
namespace App\UseCases\Loan;

use App\Models\Document;
use App\Models\Loan;
use App\Services\Exchange1C\API;

class LoanService
{
    private API $api;

    public function __construct(API $api)
    {
        $this->api = $api;
    }

    /**
     * @param $loanNumber
     * @param $loanGuid
     * @param $userGuid
     * @param $documents
     * @return Loan|\Illuminate\Database\Eloquent\Model
     */
    public function addLoan($loanGuid, $userGuid)
    {
        return Loan::create([
            'loan_guid' => $loanGuid,
            'user_guid' => $userGuid,
        ]);
    }

    public function getLoanByUserGuid($userGuid)
    {
        return Loan::whereUserGuid($userGuid)
            ->orderBy('id', 'desc')
            ->with(['documents'])
            ->first();
    }

    public function isExistLoan($loanGuid)
    {
        return Loan::whereLoanGuid($loanGuid)->first() ? true : false;
    }
}
