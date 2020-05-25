<?php
namespace App\Services\SendSms;

interface Sender
{
    public function send($phone, $text);
}
