<?php

namespace App\Actions;

use App\Exceptions\AuthCodeErrorException;
use App\Models\User;
use App\Services\AuthCodeService\AuthCodeServiceInterface;

class CheckCodeAction
{
    public function __construct(
        private User $user,
        private int  $code
    )
    {
    }


    /**
     * @throws AuthCodeErrorException
     */
    public function run(): void
    {
        $codeService = app(AuthCodeServiceInterface::class, ['phone' => $this->user->phone]);

        $check = $codeService->checkCode($this->code);
        if (!$check) {
            throw new AuthCodeErrorException;
        }
    }
}
