<?php

namespace App\Exceptions;

use Throwable;

class AuthCodeErrorException extends BaseException
{
    public function __construct($message = '', $code = 400, Throwable $previous = null)
    {
        if ($message == '') {
            $message = 'Код авторизации неверен';
        }
        parent::__construct($message, $code, $previous);
    }
}
