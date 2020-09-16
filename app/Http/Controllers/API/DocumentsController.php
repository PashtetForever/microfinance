<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Loan;
use App\Services\Exchange1C\API;
use App\Services\Loan\LoanService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentsController extends Controller
{
    private API $api;
    private LoanService $loanService;

    public function __construct(API $api, LoanService $loanService)
    {
        $this->api = $api;
        $this->loanService = $loanService;
    }

    public function getFiles(Request $request)
    {
        return $this->loanService->getLoanByUserGuid($request['userGuid']);
    }

    public function loadFiles(Request $request)
    {
        $response = $this->api->getFileList($request['sessionId'], $request['smsCode'], $request['loanGuid']);
        $loan = Loan::whereLoanGuid($request['loanGuid'])->first();

        if(!$loan)
            return response()->json(['error' => 'Не найдена заявка для загрузки документов'], 500);

        $documents = [];

        foreach ($response as $file) {
            $documentPath = $this->loanService->addDocumentToLoan($loan, $request['sessionId'], $file);
            $documents[$documentPath] =  $file['Description'];
        }

        return $documents;
    }
}
