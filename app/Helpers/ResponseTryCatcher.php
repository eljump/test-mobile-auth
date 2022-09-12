<?php

namespace App\Helpers;

use App\Exceptions\BaseException;
use Exception;
use Illuminate\Validation\ValidationException;

class ResponseTryCatcher
{
    /**
     * @throws ValidationException
     */
    public static function run(callable $call): array
    {
        try {
            $call();
        } catch (ValidationException $validationException) {
            throw $validationException;
        } catch (BaseException $exception) {
            return ["message" => $exception->getMessage(), 'code' => $exception->getCode()];
        } catch (Exception $exception) {
            return ["message" => $exception->getMessage(), 'code' => 500];
        }

        return [];
    }
}
