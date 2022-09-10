<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        //todo: валидация
        $phone = $request->input('phone');
        dd($phone);
        //todo: выбор режима
        $code = random_int(1000, 9999);
        Cache::put($phone, Hash::make($code), 3 * 60);
        //todo
        //SmsService::create($phone, $code);

        //todo
        return response(['code' => $code]);
    }

    public function smsSend()
    {

    }
}
