<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;


//public
Route::post('/registration', [AuthController::class, 'registration']); //completed
Route::post('/login', [AuthController::class, 'login']); //completed

Route::get('/posts', [PostController::class, 'index_post_api']); //completed
Route::get('/posts/{id}', [PostController::class, 'show_post_api']); //completed
Route::delete('/posts/delete/{id}', [PostController::class, 'destroy_post_api']); //completed

//protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::post('/posts', [PostController::class, 'store']); //completed
    Route::post('/posts/{id}', [PostController::class, 'update_post_api']); //completed
    Route::post('/logout', [AuthController::class, 'logout']); //completed
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});