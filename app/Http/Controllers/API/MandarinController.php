<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MandarinPayService;

class MandarinController extends Controller
{
    private MandarinPayService $mandarinPayService;

    public function __construct(MandarinPayService $mandarinPayService)
    {
        $this->mandarinPayService = $mandarinPayService;
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
}
