<?php

use App\Http\Controllers\API\V1\ActionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\BranchController;
use App\Http\Controllers\API\V1\CityController;
use App\Http\Controllers\API\V1\FeatureController;
use App\Http\Controllers\API\V1\GymController;
use App\Http\Controllers\API\V1\SubscriptionPlanController;

Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('jwt.auth')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::apiResource('gyms', GymController::class);
        Route::apiResource('subscription-plans', SubscriptionPlanController::class);
        Route::apiResource('cities', CityController::class);
        Route::apiResource('branches', BranchController::class);
        Route::apiResource('actions', ActionController::class);
        Route::apiResource('features', FeatureController::class);
    });
});
