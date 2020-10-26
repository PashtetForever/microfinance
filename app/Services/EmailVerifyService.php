<?php

namespace App\Services;

use App\Models\EmailVerify;
use Carbon\Carbon;
use Log;

class EmailVerifyService
{
    public function sendVerifyMail(string $email, string $userGuid)
    {
        $code = rand(1111, 9999);

        Log::info('Отпрвка письма для проверки пользователя', [
            'user_guid' => $userGuid,
            'code' => $code,
            'email' => $email
        ]);

        EmailVerify::create([
            'user_guid' => $userGuid,
            'code' => $code,
            'email' => $email
        ]);

        mail($email, 'mkksentimo.ru: Подтверждение электронной почты', "Ваш код активации: $code", 'From: info@mkksentimo.ru');
    }

    public function isCorrectVerify(string $userGuid, string $code)
    {
        $row = EmailVerify::where([
            'user_guid' => $userGuid,
            'code' => $code
        ])->first();

        if($row) {
            $row->verify_at = Carbon::now();
            $row->save();
            return true;
        }
        else return false;
    }
}
