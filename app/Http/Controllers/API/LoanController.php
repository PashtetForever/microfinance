<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Loan;
use App\Services\Exchange1C\API;
use App\UseCases\Loan\LoanService;
use App\UseCases\Loan\DocumentsService;
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
        //todo: Сделать нормальную проерку на 200 код (через Exception)
         $responseCreateLoan = $this->api->requestCreateLoan($request['sessionId'], $request['sum'], $request['days']);
         if($responseCreateLoan->getStatusCode() == 200) {
             $responseCreateLoan = (array)$responseCreateLoan->getData(true);
             $loan = $this->loanService->addLoan($responseCreateLoan['GUID'], $request['userGuid']);
             $documentList = (array)$this->api->getFileList($request['sessionId'], $request['smsCode'], $responseCreateLoan['GUID'])->getData(true);
             $contract = (array)$this->api->getFillContract($request['sessionId'], $responseCreateLoan['GUID'])->getData(true);
             $documents = [];
             foreach ($documentList as $item) {
                 $documents[$this->documentsService->addDocumentToLoan(
                     $loan, $request['sessionId'], $item['Description'], $item['FileName'], $request['smsCode'])] = $item['Description'];
             }

             $this->documentsService->addDocumentToLoan($loan, $request['sessionId'], 'Договор займа', $contract['FileName'], '');

             return response()->json([
                 'loan' => $responseCreateLoan,
                 'documents' => $documents
             ]);
         } else {
             return $responseCreateLoan;
         }
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

    public function signContract(Request $request)
    {
        $loan = $this->loanService->getLoanByUserGuid($request['userGuid']);
        $fillContract = $this->documentsService->getContract($loan, $request['smsCode']);

        $signContractFile = $this->api->requestSignContract($request['sessionId'], $request['smsCode'], $loan->loan_guid);
        if($signContractFile->getStatusCode() == 200){
            $signContractFile = (array)$signContractFile->getData(true);

            $this->documentsService->addDocumentToLoan(
                $loan, $request['sessionId'], $signContractFile['Description'], $signContractFile['FileName'], $request['smsCode']);

            $fillContract->delete();
        } else {
            return $signContractFile;
        }

    }

    public function getContractData(Request $request)
    {
        return $this->api->getLastContractData($request['sessionId'], $request['loanGuid']);
    }
}
