<?php

namespace App\Services\SendAuthCode;

class SendAuthCodeService
{
    private SendAuthCodeStrategyInterface $strategy;

    public function __construct(string $strategy)
    {
        $this->strategy = app($strategy);
    }

    public function setRecipient($recipient)
    {
        $this->strategy->setRecipient($recipient);
    }

    public function setCode($code)
    {
        $this->strategy->setCode($code);
    }

    public function send()
    {
        $this->strategy->send();
    }

}
