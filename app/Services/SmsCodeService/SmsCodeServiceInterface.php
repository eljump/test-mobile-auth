<?php

namespace App\Services\SmsCodeService;

interface SmsCodeServiceInterface
{
    public function __construct(int $phone);

    public function checkCode(int $code): bool;

    public function getNewCode(): int;
}
