<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

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
$prefixSanctum = 'auth:sanctum';

Route::post('/login', [AuthController::class, 'login']);

Route::middleware([$prefixSanctum])->group(function () {
    Route::get('/user/show', [UserController::class, 'show']);
    Route::put('/user', [UserController::class, 'update']);
});

Route::middleware($prefixSanctum)->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([$prefixSanctum, 'admin'])->group(function () {
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
});
