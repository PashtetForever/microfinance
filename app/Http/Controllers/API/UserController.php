<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Exchange1C\API;
use App\UseCases\Auth\AuthService;
use App\UseCases\EmailVerifyService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private API $api;
    private AuthService $authService;
    private EmailVerifyService $emailVerifyService;

    public function __construct(API $api, AuthService $authService, EmailVerifyService $emailVerifyService)
    {
        $this->api = $api;
        $this->authService = $authService;
        $this->emailVerifyService = $emailVerifyService;
    }

    public function login(Request $request)
    {
        $response = $this->api->login($request['login'], $request['password']);
        if($response->getStatusCode() == 200)
            $this->authService->sendVerifyCode($request['phone']);
        return $response;
    }

    public function checkLoginVerifyCode(Request $request)
    {
        try {
            return $this->authService->isVerifyCode($request['phone'], $request['code']);
        } catch (\DomainException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        }
    }

    public function getContactData(Request $request)
    {
        return $this->api->getPersonalUserInfo($request['sessionId']);
    }

    public function setContactData(Request $request)
    {
        return $this->api->setPersonalUserInfo($request['sessionId'], $request['fio'], $request['email']);
    }

    public function sendEmailVerify(Request $request)
    {
        $this->emailVerifyService->sendVerifyMail($request['email'], $request['userGuid']);
    }

    public function checkEmailVerify(Request $request)
    {
        return response()->json($this->emailVerifyService->isCorrectVerify($request['userGuid'], $request['code']));
    }

    public function setMandarin(Request $request)
    {
        $response = $this->api->setMandarin($request['sessionId'], $request['mandarinId'], $request['phone'], $request['email']);
        \Log::info('Отправка mandarinid для привязки в 1С. Ответ - ' . $response->getData()->Message);
        return $response;
    }

    public function sendSmsCode(Request $request)
    {
        $this->authService->sendVerifyCode($request['phone']);
    }

    public function restorePassword(Request $request)
    {
        return $this->api->restorePassword($request['lastName'], $request['firstName'], $request['middleName'], $request['phone']);
    }
    public function changePassword(Request $request)
    {
        return $this->api->changePassword($request['sessionId'], $request['oldPassword'], $request['newPassword']);
    }
}
