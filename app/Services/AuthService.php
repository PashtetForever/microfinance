<?php
namespace App\Services;

use App\Services\SendSms\SmsSender;
use App\Models\UserVerify;
use Carbon\Carbon;

class AuthService
{
    private SmsSender $sender;

    public function __construct(SmsSender $sender)
    {
        $this->sender = $sender;
    }

    public function sendVerifyCode(string $phone)
    {
        if(env('APP_DEBUG'))
            return;

        $phone = $this->phoneToSiteFormat($phone);
        $code = rand(111111,999999);

        $userVerify = new UserVerify([
            'phone' => $phone,
            'code' => $code
        ]);

        $userVerify->save();
        $this->sender->send($phone, "Код подтверждения: $code");
    }

    public function isVerifyCode(string $phone, string $code)
    {
        if(env('APP_DEBUG') && env('APP_ENV') != 'testing')
            return true;

        $foundRow = UserVerify::where([
            'phone' => $this->phoneToSiteFormat($phone),
            'code' => $code]
        )->first();

        if(!$foundRow)
            throw new \DomainException("Не верно введен проверочный код");

        if($foundRow->verify_at != null)
            throw new \DomainException("Данный код уже был активирован ранее");

        $foundRow->verify_at = Carbon::now();
        $foundRow->save();

        return true;
    }

    public function phoneToSiteFormat(string $phone)
    {
        return str_replace(['(', ')', ' ', '+', '-'], '', $phone);
    }
}
