<?php

namespace App\Actions;

use App\Services\SendAuthCode\SendAuthCodeService;
use App\Services\SendAuthCode\Strategies\SendAuthCodeByEMAIL;
use App\Services\SendAuthCode\Strategies\SendAuthCodeBySMS;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

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
        //todo:service
        $code = random_int(1000, 9999);
        Cache::put($this->phone, Hash::make($code), 5 * 60);

        $recipient = !$this->impersonate ? $this->phone : config('custom.admin_email');
        $strategy = !$this->impersonate ? SendAuthCodeBySMS::class : SendAuthCodeByEMAIL::class;

        $sendCodeService = new SendAuthCodeService($strategy);
        $sendCodeService->setRecipient($recipient);
        $sendCodeService->setCode($code);
        $sendCodeService->send();
    }
}
