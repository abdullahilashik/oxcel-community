<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PostController::class,'index'])->name('posts')->middleware('auth');

Route::group([],function(){
    Route::get('/login', [AuthController::class,'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class,'login']);
    Route::get('/verify-otp', [AuthController::class, 'verifyOtpForm'])->name('verify.otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

    Route::get('/register', [AuthController::class,'showRegister'])->name('register')->middleware('guest');
    Route::post('/register', [AuthController::class,'register']);

    Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');
});

Route::group(['prefix'=>'posts','middleware'=>'auth'], function(){
    Route::get('/',[PostController::class,'search'])->name('posts.index');
    Route::get('/create',[PostController::class,'create'])->name('posts.create');
    Route::get('/mark-read',[PostController::class,'markAsRead'])->name('posts.notification');
    Route::post('/create',[PostController::class,'store']);

    Route::group(['prefix'=>'comment'], function(){
        // post comment related tasks
        Route::post('/', [PostCommentController::class,'store'])->name('comment.create');
        Route::post('/reply-to/{post}', [PostCommentController::class,'replyTo'])->name('comment.reply');
    });

    // stays at bottom always
    Route::get('/{slug}',[PostController::class,'show'])->name('posts.show');
});

// done
Route::group(['prefix'=>'bookmarks','middleware'=>'auth'], function(){
    Route::get('/', [BookmarkController::class,'index'])->name('bookmarks.index');
    Route::post('/', [BookmarkController::class,'store'])->name('bookmarks.create');
    Route::delete('/{id}', [BookmarkController::class,'delete'])->name('bookmarks.delete');
});
// done
Route::group(['prefix'=>'favorite','middleware'=>'auth'], function(){
    Route::get('/', [FavoriteController::class,'index'])->name('favorite.index');
    Route::post('/', [FavoriteController::class,'store'])->name('favorite.create');
    Route::delete('/{id}', [FavoriteController::class,'delete'])->name('favorite.delete');
});

Route::group(['prefix'=>'account', 'middleware'=>'auth'], function(){
    Route::get('/', [AccountController::class,'index'])->name('account.index');
    Route::get('/edit', [AccountController::class,'edit'])->name('account.edit');
    Route::post('/edit', [AccountController::class,'update']);
});
