<?php

namespace App\Services\SendAuthCode;

interface SendAuthCodeStrategyInterface
{
    public function setCode(int $code): void;
    public function setRecipient($recipient): void;
    public function send(): void;
}
