<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->middleware('headers')->group(function () {
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::middleware('impersonate')->post('login', 'login');
        Route::middleware('throttle:1,1')
            ->post('sms/send', 'smsSend');
    });
});
