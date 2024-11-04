<?php

use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\ApiPostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;


Route::group(['prefix'=>'posts'], function(){
    Route::get('/search', [ApiPostController::class,'search'])->name('posts.search');
});

// login
Route::post('/login', [APIAuthController::class, 'login'])->name('login');
// logout
Route::post('/logout', [APIAuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
// register
Route::post('/register', [APIAuthController::class, 'register'])->name('register');
// reset password
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if($status === Password::RESET_LINK_SENT){
        return response()->json(["message" => "Password reset link sent"]);
    }else{
        return response()->json(["message" => $status]);
    }
})->middleware('guest')->name('password.email');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );
    if($status === Password::PASSWORD_RESET){
        return response()->json(
            [
                "message" => __($status)
            ]
        );
    } else {
        return response()->json(
            [
                "message" => __($status)
            ]
        );
    }
})->middleware('guest')->name('password.update');
