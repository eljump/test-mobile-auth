<?php

namespace App\Http\Controllers;

use App\Actions\CheckCodeAction;
use App\Actions\LoginAction;
use App\Helpers\ResponseTryCatcher;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $phone = $request->input('phone');
        $impersonate = $request->input('impersonate');

        $action = fn() => (new LoginAction($phone, $impersonate))->run();

        $response = ResponseTryCatcher::run($action);
        if ($response != []) {
            return response()->json([
                'message' => $response['message'],
                'code' => $response['code']
            ]);
        }
        return response()->json([], 200);
    }

    /**
     * @throws ValidationException
     */
    public function checkCode(CheckCodeRequest $request)
    {
        $user = User::wherePhone($request->input('phone'))->first();
        $code = $request->input('code');

        $action = fn() => (new CheckCodeAction($user, $code))->run();

        $response = ResponseTryCatcher::run($action);
        if ($response != []) {
            return response()->json([
                'message' => $response['message'],
                'code' => $response['code']
            ]);
        }

        return response()->json([
            'user' => UserResource::make($user),
            'token' => [
                'value' => AuthService::createNewToken($user),
                'type' => 'Bearer'
            ]
        ], 200);
    }
}
