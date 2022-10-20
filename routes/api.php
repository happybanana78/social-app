<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

Route::post('/users', [AuthController::class, 'getPostUser']);

Route::post('/users/byname', [AuthController::class, 'getUserByUsername']);

Route::post('/users/register', [AuthController::class, 'create']);

Route::post('/users/login', [AuthController::class, 'login']);

Route::post('/users/profile', [AuthController::class, 'changeProfile']);

Route::get('/posts', [PostController::class, 'index']);

Route::post('/posts/like', [PostController::class, 'like']);

Route::post('/posts/create', [PostController::class, 'storePost']);

Route::post('/posts/delete', [PostController::class, 'deletePost']);

Route::post('/posts/comment', [PostController::class, 'storeComment']);

Route::get('/posts/comments/{id}', [PostController::class, 'getComments']);

Route::get('/posts/{id}', [PostController::class, 'getUserPosts']);