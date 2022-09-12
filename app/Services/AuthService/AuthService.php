<?php


use App\Models\User;

class AuthService
{
    public static function createNewToken(User $user): string
    {
        $user->tokens()->delete();

        return $user->createToken('auth_token')->plainTextToken;
    }
}
