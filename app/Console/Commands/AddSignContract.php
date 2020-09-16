<?php

namespace App\Console\Commands;

use App\Models\Loan;
use App\Services\Exchange1C\API;
use App\Services\Loan\DocumentsService;
use App\Services\Loan\LoanService;
use Illuminate\Console\Command;

class AddSignContract extends Command
{
    protected $signature = 'loan:add-sign-contract {loanGuid}';
    protected $description = 'Добавление подписанного договора к займу';

    /**
     * @var LoanService
     */
    private LoanService $loanService;

    /**
     * @var API
     */
    private API $api;

    /**
     * @var DocumentsService
     */
    private DocumentsService $documentsService;

    public function __construct(LoanService $loanService, DocumentsService $documentsService, API $api)
    {
        parent::__construct();

        $this->loanService = $loanService;
        $this->api = $api;
        $this->documentsService = $documentsService;
    }

    public function handle()
    {
        $loanGuid = $this->argument('loanGuid');

        $loginData = (array)$this->api->login('test', 'test')->getData(true);
        $loan = Loan::whereLoanGuid($loanGuid)->first();

        if(!$loan) {
            $this->error('Не найден зйм с GUID ' . $loanGuid);
            return;
        }

        $signContractFile = $this->api->requestSignContract($loginData['SessionId'], '1', $loan->loan_guid);
        $this->documentsService->addDocumentToLoan(
            $loan, $loginData['SessionId'], $signContractFile['Description'], $signContractFile['FileName'], '1');

        $this->info('Выполнено');
    }
}
