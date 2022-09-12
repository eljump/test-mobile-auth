<?php

namespace App\Services\SmsCodeService;

use App\Exceptions\AuthCodeMissingException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class SmsCodeServiceWithCache implements SmsCodeServiceInterface
{
    private int $phone;

    public function __construct(int $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @throws AuthCodeMissingException
     */
    public function checkCode(int $code): bool
    {
        if (!Cache::has($this->phone)) {
            throw new AuthCodeMissingException;
        }

        return Hash::check($code, Cache::get($this->phone));
    }

    public function getNewCode(): int
    {
        $code = random_int(1000, 9999);
        Cache::put($this->phone, Hash::make($code), 5 * 60);
        return $code;
    }
}
