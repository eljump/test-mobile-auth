<?php

namespace App\Services\SendAuthCode\Strategies;

use App\Services\SendAuthCode\SendAuthCodeStrategyInterface;
use App\Services\SmsSenders\SmsSenderInterface;

class SendAuthCodeBySMS extends SendAuthCodeAbstract implements SendAuthCodeStrategyInterface
{
    public function setRecipient($recipient): void
    {
        $this->recipient = $recipient;
    }
    public function send(): void
    {
        $smsSender = app(SmsSenderInterface::class);
        $smsSender->setPhones([$this->recipient]);
        $smsSender->setMessage("Ваш код: " . $this->code);
        $smsSender->send();
    }
}
