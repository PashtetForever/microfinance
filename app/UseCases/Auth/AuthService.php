<?php
namespace App\UseCases\Auth;

use App\Services\SendSms\Sender;
use App\Models\UserVerify;
use Carbon\Carbon;

class AuthService
{
    private Sender $sender;

    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public function sendVerifyCode(string $phone)
    {
        if(env('APP_DEBUG'))
            return;

        $phone = $this->phoneToSiteFormat($phone);
        $code = rand(000001,999999);

        $userVerify = new UserVerify([
            'phone' => $phone,
            'code' => $code
        ]);

        $userVerify->save();
        $this->sender->send($phone, "Код подтверждения: $code");
    }

    public function isVerifyCode(string $phone, string $code)
    {
        if(env('APP_DEBUG'))
            return true;

        $foundRow = UserVerify::where([
            'phone' => $this->phoneToSiteFormat($phone),
            'code' => $code]
        )->get();

        if($foundRow->isEmpty())
            throw new \DomainException("Не верно введен проверочный код");

        $foundRow = $foundRow->first();

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
