<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix'=>'posts'], function(){
    Route::get('/',[PostController::class,'index'])->name('posts');
    Route::get('/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/create',[PostController::class,'store']);
    Route::get('/{slug}',[PostController::class,'show'])->name('posts.show');
})->middleware('auth');
