<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts',[PostController::class,'index_post_api']); //completed
Route::post('/posts',[PostController::class,'store']); //completed
Route::post('/posts/{id}',[PostController::class,'update_post_api']); //completed
Route::get('/posts/{id}',[PostController::class,'show']); //completed
Route::delete('/posts/delete/{id}',[PostController::class,'destroy_post_api']); //completed

// Route::middleware('auth')->group(function (){
//     Route::get('/dashboard',[DashboardController::class,'show_post'])->name('dashboard');


//     Route::post('/post',[PostController::class,'create'])->name('post_create');
//     Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('post_edit');
//     Route::put('/post/edit/{id}',[PostController::class,'update'])->name('post_update');
//     Route::get('/post/delete/{id}',[PostController::class,'destroy'])->name('post_delete');
// });