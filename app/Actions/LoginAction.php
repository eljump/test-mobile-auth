<?php

namespace App\Actions;

use App\Services\SendAuthCode\SendAuthCodeService;
use App\Services\SendAuthCode\Strategies\SendAuthCodeByEMAIL;
use App\Services\SendAuthCode\Strategies\SendAuthCodeBySMS;
use App\Services\AuthCodeService\AuthCodeServiceInterface;
use Exception;

class LoginAction
{
    public function __construct(
        private int  $phone,
        private bool $impersonate = false
    )
    {
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $smsCodeService = app(AuthCodeServiceInterface::class, ['phone'=>$this->phone]);
        $code = $smsCodeService->getNewCode();

        $recipient = !$this->impersonate ? $this->phone : config('custom.admin_email');
        $strategy = !$this->impersonate ? SendAuthCodeBySMS::class : SendAuthCodeByEMAIL::class;

        $sendCodeService = new SendAuthCodeService($strategy);
        $sendCodeService->setRecipient($recipient);
        $sendCodeService->setCode($code);
        $sendCodeService->send();
    }
}
