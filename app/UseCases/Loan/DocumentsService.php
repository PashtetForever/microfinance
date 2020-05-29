<?php


namespace App\UseCases\Loan;

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

    public function addDocumentToLoan(Loan $loan, $sessionId, $documentName, $pathToFile, $smsCode)
    {
        $fileName = Str::slug($documentName);
        $filePath = "documents/{$loan['loan_guid']}/$fileName.pdf";
        Storage::put($filePath, '');
        $this->api->getFile($sessionId, $pathToFile, $filePath);

        $document = Document::create([
            'loan_id' => $loan['id'],
            'name' => $documentName,
            'file_name' => $fileName,
            'sign_code' => $smsCode,
            'signed_at' => Carbon::now()
        ]);
        $document->save();

        return $filePath;
    }

    public function getDocumentsPathsByLoan(Loan $loan)
    {
        $documents = Document::whereLoanId($loan['id'])->get();
        $result = [];

        foreach ($documents as $document) {
            $result[] = [
                'path' => '/storage/documents/' . $loan['loan_guid'] . '/' . $document['file_name'] . '.pdf',
                'name' => $document->name,
                'smsCode' => $document->sign_code,
                'date' => $document->created_at->format('d.m.Y')
            ];
        }

        return $result;
    }

    public function getContract(Loan $loan, $smsCode): Document
    {
        return $loan->documents()->get()->where('name', '=', 'Договор займа (заполненный)')->first();

    }
}
