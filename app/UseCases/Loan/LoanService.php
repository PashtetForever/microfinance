<?php
namespace App\UseCases\Loan;

use App\Models\Document;
use App\Models\Loan;
use App\Services\Exchange1C\API;

class LoanService
{
    private API $api;
    private DocumentsService $documentsService;

    public function __construct(API $api, DocumentsService $documentsService)
    {
        $this->api = $api;
        $this->documentsService = $documentsService;
    }

    public function addLoan($userGuid, $sessionId, $sum, $days, $smsCode): array
    {
        $responseCreateLoan = $this->api->requestCreateLoan($sessionId, $sum, $days);
        $loanGuid = $responseCreateLoan['GUID'];

        $loan = Loan::create([
            'loan_guid' => $loanGuid,
            'user_guid' => $userGuid,
            'number' => $responseCreateLoan['Num'],
            'sum' => $sum,
            'days' => $days
        ]);

        $documentsResponse = (array)$this->api->getFileList($sessionId, $smsCode, $loanGuid)->getData(true);
        $documents = [];

        foreach ($documentsResponse as $document) {
            $documents[$this->documentsService->addDocumentToLoan($loan, $sessionId, $document['Description'], $document['FileName'], $smsCode)] = $document['Description'];
        }

        $contract = $this->api->getFillContract($sessionId, $loanGuid)[0];
        $this->documentsService->addDocumentToLoan($loan, $sessionId, $contract->Description, $contract->FileName);

        return [
            'loan' => $responseCreateLoan,
            'documents' => $documents
        ];
    }


    /**
     * @param $userGuid
     * @return Loan|null
     */
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
