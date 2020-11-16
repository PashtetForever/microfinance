<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Services\Exchange1C\API;
use App\Services\Loan\DocumentsService;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use App\Services\MandarinPayService;

class MandarinController extends Controller
{

    private MandarinPayService $mandarinPayService;
    private API $api;
    private DocumentsService $documentsService;

    public function __construct(MandarinPayService $mandarinPayService, API $api, DocumentsService $documentsService)
    {
        $this->mandarinPayService = $mandarinPayService;
        $this->api = $api;
        $this->documentsService = $documentsService;
    }

    public function identify(Request $request)
    {
        //todo: Переделать чтобы данные передавались отдельно, чтобы отлавливать когда и каких данных не хватило для идентификации
        return $this->mandarinPayService->identify($request['mandarinLogin'], $request['data']);
    }

    public function binding(Request $request)
    {
        return $this->mandarinPayService->binding($request['mandarinLogin'], $request['email'], $request['phone']);
    }

    public function checkSms(Request $request)
    {
        return $this->mandarinPayService->checkSmsCode($request['mandarinLogin'], $request['mandarinSessionId'], $request['code']);
    }

    public function getIdentifyResult(Request $request)
    {
        return $this->mandarinPayService->getIdentifyResult($request['mandarinLogin'], $request['smsId']);
    }

    public function repaymentLoan(Request $request)
    {
        $config = config('mandarin');

        return $this->mandarinPayService->payment
        ($request['mandarinLogin'], $request['orderId'], $request['price'], $request['email'],
            $config['url_return_payment'], $config['url_callback_payment']);
    }

    public function callbackRepaymentLoan(Request $request)
    {
        try {
            if ($request['status'] != 'success') {
                \Log::error('Ошибка погашения займа ' . $request['orderId'], $request->toArray());
                return "OK";
            }

            $response = $this->api->requestReturnLoan($request['orderId'], $request['price']);
            Loan::whereLoanGuid($request['orderId'])->firstOrFail()->delete();
            \Log::info('Погашение займа ' . $request['orderId'] . '. успешно выполнено', $response);
            return "OK";
        } catch (ServerException $exception) {
            mail('pavel@dvinaweb.ru', 'Ошибка оплаты в 1С', "<id>${$request['orderId']}</id><sum>${$request['price']}</sum>");
            return response('OK', 200);
        }
    }

    public function paymentExtensionPercent(Request $request)
    {
        $config = config('mandarin');
        \Log::info('Оплата процентов для продления займа', $request->toArray());
        return $this->mandarinPayService->payment
        ($request['mandarinLogin'], $request['orderId'], $request['price'], $request['email'],
            $config['url_return_extension'], $config['url_callback_extension']);
    }

    public function callbackExtensionPercent(Request $request)
    {
        $requestArray = explode('#', $request['orderId']);
        $this->documentsService->openAllDocuments($requestArray[0]);
        $this->api->extendLoan($requestArray[0], $requestArray[1]);
        \Log::info('Продление займа ' . $requestArray[0] . '. успешно выполнено');
        return "OK";
    }
}
