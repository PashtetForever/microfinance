<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Loan;
use App\Services\Exchange1C\API;
use App\UseCases\Loan\LoanService;
use App\UseCases\Loan\DocumentsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    private LoanService $loanService;
    private API $api;
    private DocumentsService $documentsService;

    public function __construct(LoanService $loanService, DocumentsService $documentsService, API $api)
    {
        $this->loanService = $loanService;
        $this->api = $api;
        $this->documentsService = $documentsService;
    }

    public function create(Request $request)
    {
        return $this->loanService
            ->addLoan($request['userGuid'], $request['sessionId'], $request['sum'], $request['days'], $request['smsCode']);
    }

    public function getLoan(Request $request)
    {
        $loan = $this->loanService->getLoanByUserGuid($request['userGuid']);
        $documents = $this->documentsService->getDocumentsPathsByLoan($loan);
        $loanData = $this->api->getCurrentLoan($request['sessionId'], $loan['loan_guid']);

        return [
            'documents' => $documents,
            'loan' => $loanData->getData()
        ];
    }

    public function isExistLoan(Request $request)
    {
        $response = $this->loanService->getLoanByUserGuid($request['userGuid']);
        return !empty($response) ?
            response()->json(['data' => $response->loan_guid]) : response()->json(['data' => false]);
    }

    public function signContract(Request $request)
    {
        $loan = $this->loanService->getLoanByUserGuid($request['userGuid']);
        $fillContract = $this->documentsService->getContract($loan, $request['smsCode']);

        $signContractFile = $this->api->requestSignContract($request['sessionId'], $request['smsCode'], $loan->loan_guid);
        $this->documentsService->addDocumentToLoan(
            $loan, $request['sessionId'], $signContractFile['Description'], $signContractFile['FileName'], $request['smsCode']);

        $fillContract->delete();
    }

    public function getContractData(Request $request)
    {
        $response = $this->api->getLastContractData($request['sessionId'], $request['loanGuid']);

        foreach ($response as $key => $item) {
            $response[$key] = str_replace(',', '.', $item);
        }

        return $response;
    }

    public function extendLoan(Request $request)
    {
        $response = $this->api->extendLoan($request['loanGuid'], $request['returnDate']);
        $this->documentsService->openAllDocuments($request['loanGuid']);
        return $response;
    }

    public function getExtendLoanDocuments(Request $request)
    {
        $extendDocuments = $this->api->getFileExtendLoan($request['sessionId'], $request['smsCode'], $request['loanGuid']);
        $loan = Loan::whereLoanGuid($request['loanGuid'])->firstOrFail();
        $files = [];
        foreach ($extendDocuments as $document) {
            $filePath = $this->documentsService->addDocumentToLoan(
                $loan, $request['sessionId'], $document->Description, $document->FileName, $request['smsCode'], true);
            $files[] = [
                'name' => $document->Description,
                'path' => env('MIX_APP_URI') .  '/storage/' . $filePath,
                'smsCode' => $request['smsCode'],
                'date' => Carbon::now()->format('d.m.Y'),
                'hide' => 1
            ];
        }

        return $files;
    }
}
