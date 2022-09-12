<?php

namespace App\Services\AuthCodeService;

interface AuthCodeServiceInterface
{
    public function __construct(int $phone);

    public function checkCode(int $code): bool;

    public function getNewCode(): int;
}
