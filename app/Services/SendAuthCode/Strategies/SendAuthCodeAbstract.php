<?php

namespace App\Services\SendAuthCode\Strategies;

use App\Services\SendAuthCode\SendAuthCodeStrategyInterface;

abstract class SendAuthCodeAbstract implements SendAuthCodeStrategyInterface
{
    protected int $code;
    protected int|string $recipient;

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function setRecipient($recipient): void
    {
        $this->recipient = $recipient;
    }

    abstract public function send(): void;
}
