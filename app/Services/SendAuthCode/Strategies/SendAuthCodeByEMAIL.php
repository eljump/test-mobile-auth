<?php

namespace App\Services\SendAuthCode\Strategies;

use App\Mail\AuthCodeImpersonate;
use App\Services\SendAuthCode\SendAuthCodeStrategyInterface;
use Illuminate\Support\Facades\Mail;

class SendAuthCodeByEMAIL extends SendAuthCodeAbstract implements SendAuthCodeStrategyInterface
{
    public function send(): void
    {
        Mail::to($this->recipient)->send(new AuthCodeImpersonate($this->code));
    }
}
