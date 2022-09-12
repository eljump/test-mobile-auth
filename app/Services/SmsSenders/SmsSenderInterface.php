<?php

namespace App\Services\SmsSenders;

interface SmsSenderInterface
{
    public function setPhones(array $phones): void;

    public function setMessage(string $message): void;

    public function send(): void;
}
