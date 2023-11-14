<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/// Auth

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'indexLogin')->name('loginScreen');

    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/posts', [PostsController::class, 'indexPosts'])->name('postsScreen');

Route::get('/post', [PostController::class, 'indexPost'])->name('postScreen');

