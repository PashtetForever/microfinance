<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Exchange1C\API;
use Illuminate\Http\Request;
use App\Services\MandarinPayService;

class MandarinController extends Controller
{

    private MandarinPayService $mandarinPayService;
    private API $api;

    public function __construct(MandarinPayService $mandarinPayService, API $api)
    {
        $this->mandarinPayService = $mandarinPayService;
        $this->api = $api;
    }

    public function identify(Request $request)
    {
        //todo: Переделать чтобы данные передавались отдельно, чтобы отлавливать когда и каких данных не хватило для идентификации
        return $this->mandarinPayService->identify($request['data']);
    }

    public function binding(Request $request)
    {
        return $this->mandarinPayService->binding($request['email'], $request['phone']);
    }

    public function checkSms(Request $request)
    {
        return $this->mandarinPayService->checkSmsCode($request['mandarinSessionId'], $request['code']);
    }

    public function getIdentifyResult(Request $request)
    {
        return $this->mandarinPayService->getIdentifyResult($request['smsId']);
    }

    public function repaymentLoan(Request $request)
    {
        $config = config('mandarin');

        return $this->mandarinPayService->payment
        ($request['orderId'], $request['price'], $request['email'],
            $config['url_return_payment'], $config['url_callback_payment']);
    }

    public function callbackRepaymentLoan(Request $request)
    {
        $response = $this->api->requestReturnLoan($request['order_id'], $request['price']);
        \Log::info('Погашение займа ' . $request['order_id'] . '. успешно выполнено');
        return response()->setContent('OK')->setStatusCode(200);
    }

    public function paymentExtensionPercent(Request $request)
    {
        $config = config('mandarin');

        return $this->mandarinPayService->payment
        ($request['orderId'], $request['price'], $request['email'],
            $config['url_return_extension'], $config['url_callback_extension']);
    }

    public function callbackExtensionPercent(Request $request)
    {
        $requestArray = explode('#', $request['order_id']);
        $this->api->extendLoan($requestArray[0], $requestArray[1]);
        \Log::info('Продление займа ' . $requestArray[0] . '. успешно выполнено');
        return response()->setContent('OK')->setStatusCode(200);
    }
}
