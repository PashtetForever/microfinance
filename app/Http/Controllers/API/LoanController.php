<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Exchange1C\API;
use App\UseCases\Loan\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    private LoanService $loanService;
    private API $api;

    public function __construct(LoanService $loanService, API $api)
    {
        $this->loanService = $loanService;
        $this->api = $api;
    }

    public function create(Request $request)
    {
        return $this->api->requestCreateLoan($request['sessionId'], $request['sum'], $request['days']);
    }

    public function getLoan(Request $request)
    {
        $loan = $this->api->getCurrentLoan($request['sessionId'], $request['loanGuid']);

        if(!$this->loanService->isExistLoan($loan['GUID'])) {
            $this->loanService->addLoan($loan['Number'], $loan['GUID'], $request['userGuid']);
        }

        return $loan;
    }
}
