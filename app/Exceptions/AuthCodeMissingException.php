<?php

namespace App\Exceptions;

use Throwable;

class AuthCodeMissingException extends BaseException
{
    public function __construct($message = '', $code = 419, Throwable $previous = null)
    {
        if ($message == '') {
            $message = 'Код авторизации отсутствует, попробуйте запросить новый';
        }
        parent::__construct($message, $code, $previous);
    }
}
