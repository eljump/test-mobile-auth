<?php

namespace App\Exceptions;

use App\Helpers\MappedImplode;
use Throwable;

class PHONESException extends BaseException
{
    public function __construct(array $messages, $code = 500, Throwable $previous = null)
    {
        $message = MappedImplode::run(";\n", $messages, ": ");
        parent::__construct($message, $code, $previous);
    }
}
