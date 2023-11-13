<?php

use App\Http\Controllers\Resource\AuthController;
use App\Http\Controllers\Resource\CommentController;
use App\Http\Controllers\Resource\LikeController;
use App\Http\Controllers\Resource\LikeDislikeController;
use App\Http\Controllers\Resource\PostController;
use App\Http\Controllers\Resource\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('user', UserController::class);
Route::resource('post', PostController::class);
Route::resource('comment', CommentController::class);
Route::resource('like', LikeDislikeController::class);


Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/register', [AuthController::class, 'register']);
});
Route::controller(LikeController::class)->group(function () {

    Route::patch('/likes', [LikeController::class, 'update']);
    Route::delete('/likes', [LikeController::class, 'destroy']);
});

Route::get('/test', function () {
    return response()->json(['message' => 'halloo']);
});
