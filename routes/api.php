<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\{
    Auth\LoginController,
    Auth\RegisterController,
    User\UserController
};


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('auth/login', LoginController::class);
Route::post('auth/register', RegisterController::class);
    
Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::get('user/logout', [UserController::class, 'logout']);
});
