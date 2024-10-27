<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PostController::class,'index'])->name('posts')->middleware('auth');

Route::group([],function(){
    Route::get('/login', [AuthController::class,'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class,'login']);

    Route::get('/register', [AuthController::class,'showRegister'])->name('register')->middleware('guest');
    Route::post('/register', [AuthController::class,'register']);

    Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');
});

Route::group(['prefix'=>'posts','middleware'=>'auth'], function(){
    Route::get('/',[PostController::class,'index'])->name('posts');
    Route::get('/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/create',[PostController::class,'store']);
    Route::get('/{slug}',[PostController::class,'show'])->name('posts.show');
});


Route::group(['prefix'=>'account', 'middleware'=>'auth'], function(){
    Route::get('/', [AccountController::class,'index'])->name('account.index');
    Route::get('/edit', [AccountController::class,'edit'])->name('account.edit');
    Route::post('/edit', [AccountController::class,'update']);
});
