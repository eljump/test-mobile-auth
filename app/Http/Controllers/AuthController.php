<?php

namespace App\Http\Controllers;

use App\Actions\LoginAction;
use App\Exceptions\BaseException;
use App\Helpers\ResponseTryCatcher;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

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

    public function smsSend()
    {

    }
}
