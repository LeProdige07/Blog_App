<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// public routes
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //User
    Route::get('/user', [App\Http\Controllers\AuthController::class, 'user']);
    Route::put('/user', [App\Http\Controllers\AuthController::class, 'update']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    //Post
    Route::get('/posts',[App\Http\Controllers\PostController::class, 'index']); // all posts
    Route::post('/posts',[App\Http\Controllers\PostController::class, 'store']); // create post
    Route::get('/posts/{id}',[App\Http\Controllers\PostController::class, 'show']); // get single post
    Route::put('/posts/{id}',[App\Http\Controllers\PostController::class, 'update']); // update post
    Route::post('/posts/{id}',[App\Http\Controllers\PostController::class, 'destroy']); // delete post

    //Comment
    Route::get('/posts/{id}/comments',[App\Http\Controllers\CommentController::class, 'index']); // all comments of a post
    Route::post('/posts/{id}/comments',[App\Http\Controllers\CommentController::class, 'store']); // create comment on a post
    Route::put('/comments/{id}',[App\Http\Controllers\CommetController::class, 'update']); // update comment
    Route::post('/comments/{id}',[App\Http\Controllers\CommentController::class, 'destroy']); // delete comment

    //Like
    Route::post('/posts/{id}/likes',[App\Http\Controllers\LikeController::class, 'likeOrUnlike']); // like or dislike back a post
});
