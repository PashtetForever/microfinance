<?php


namespace App\Services\Loan;

use App\Models\Document;
use App\Models\Loan;
use App\Services\Exchange1C\API;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Str;

class DocumentsService
{
    private API $api;

    public function __construct(API $api)
    {
        $this->api = $api;
    }

    public function addDocumentToLoan(Loan $loan, $sessionId, $documentName, $pathToFile, $smsCode = null, $isHide = false)
    {
        $fileName = Str::slug($documentName);
        $filePath = "documents/{$loan['loan_guid']}/$fileName.pdf";
        Storage::put($filePath, '');
        $this->api->getFile($sessionId, $pathToFile, $filePath);

        $values = [
            'loan_id' => $loan['id'],
            'name' => $documentName,
            'file_name' => $fileName,
            'signed_at' => Carbon::now()
        ];

        if($smsCode)
            $values['sign_code'] = (string)$smsCode;

        if($isHide)
            $values['is_hide'] = true;
        else
            $values['is_hide'] = false;

        Document::create($values)->save();

        return $filePath;
    }

    public function getContract(Loan $loan): Document
    {
        return $loan->documents()->get()->where('name', '=', 'Договор займа (заполненный)')->first();
    }

    public function openAllDocuments($loanGuid)
    {
        $loan = Loan::whereLoanGuid($loanGuid)->first();
        if(!$loan)
            return;

        $documents = Document::where(['is_hide' => true, 'loan_id' => $loan->id])->get();

        foreach ($documents as $document) {
            $document->is_hide = false;
            $document->save();
        }
    }

    public function deleteHiddenDocuments($loanGuid)
    {
        $documents = Loan::whereLoanGuid($loanGuid)->first()
            ->documents()->where('is_hide', '=', 1)
            ->get();

        /**
         * @var $document Document
         */
        foreach ($documents as $document) {
            $document->forceDelete();
        }
    }
}
