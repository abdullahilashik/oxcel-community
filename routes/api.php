<?php

use App\Http\Controllers\ApiPostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'posts'], function(){
    Route::get('/search', [ApiPostController::class,'search'])->name('posts.search');
});

?>
