<?php

namespace App\Services\AuthCodeService;

use App\Exceptions\AuthCodeErrorException;
use App\Exceptions\AuthCodeMissingException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthCodeServiceWithCache implements AuthCodeServiceInterface
{
    private int $phone;

    public static function codeSize(): int
    {
       return 4;
    }

    public function __construct(int $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @throws AuthCodeMissingException
     * @throws AuthCodeErrorException
     */
    public function checkCode(int $code): bool
    {
        if (!Cache::has($this->phone)) {
            throw new AuthCodeMissingException;
        }

        $check = Hash::check($code, Cache::get($this->phone));
        if (!$check) {
            throw new AuthCodeErrorException;
        }
        return true;
    }

    public function getNewCode(): int
    {
        $code = random_int(1000, 9999);
        Cache::put($this->phone, Hash::make($code), 5 * 60);
        return $code;
    }

}
