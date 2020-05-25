<?php
namespace App\UseCases\Loan;

use App\Models\Document;
use App\Models\Loan;
use App\Services\Exchange1C\API;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

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
    public function addLoan($loanNumber, $loanGuid, $userGuid)
    {
        return Loan::create([
            'loan_id' => $loanNumber,
            'loan_guid' => $loanGuid,
            'user_guid' => $userGuid,
        ]);
    }

    public function getLoanByUserGuid($userGuid)
    {
        return Loan::whereUserGuid($userGuid)
            ->orderBy('id', 'desc')
            ->with(['documents'])
            ->firstOrFail();
    }

    public function isExistLoan($loanGuid)
    {
        return Loan::whereLoanGuid($loanGuid)->first() ? true : false;
    }

    public function addDocumentToLoan(Loan $loan, $sessionId, $file)
    {
        $content = $this->api->getFile($sessionId, $file['FileName']);
        $fileName = Str::slug($file['Description']) . '.pdf';
        $filePath = "documents/{$loan['loan_guid']}/$fileName.pdf";

        Storage::put($filePath, $content);

        Document::create([
            'loan_id' => $loan['id'],
            'name' => $file['Description'],
            'file_name' => $fileName,
        ]);

        return $filePath;
    }
}
