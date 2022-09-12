<?php

namespace App\Rules;

class PhoneRule
{
    public static function get(): string
    {
        return 'required|integer|starts_with:79|min:79000000000|max:79999999999|exists:users,phone';
    }
}
