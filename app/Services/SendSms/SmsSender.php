<?php
namespace App\Services\SendSms;

interface SmsSender
{
    public function send($phone, $text);
}
