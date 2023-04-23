<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ChirpLikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\RechirpController;
use App\Http\Controllers\TrendingTopicController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/v1')->group(function () {
        Route::apiResource('users', UserController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::apiResource('chirps', ChirpController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::apiResource('rechirps', RechirpController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::apiResource('chirp_likes', ChirpLikeController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::apiResource('trending_topics', TrendingTopicController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::apiResource('follows', FollowController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    });
});

require __DIR__.'/auth.php';

