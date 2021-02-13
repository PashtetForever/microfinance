<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use SerializesModels;

    public int $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject(env('APP_NAME') . '. Подтверждение электронной почты')
            ->view('mail.verify-email');
    }
}
