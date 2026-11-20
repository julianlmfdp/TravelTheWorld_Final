<?php


use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


// Públicas: no necesitan token
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
});

// Protegidas: exigen Authorization: Bearer <token>
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/profile', [UserController::class, 'profile']);
    Route::put('users/update',  [UserController::class, 'update']);

    // products deja de ser público y pasa a estar protegido
    Route::apiResource('reviews', ReviewController::class);
});



Route::apiResource('users', UserController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('countries', CountryController::class);
Route::apiResource('cities', CityController::class);
