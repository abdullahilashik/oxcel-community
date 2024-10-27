<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    // make the login happen
    public function login(LoginFormRequest $request){
        $validated = $request->validated();
        if(Auth::attempt($validated)){
            return redirect('/');
        }

        return back()->with('error', 'Failed to login');
    }
    // show register form
    public function showRegister(){
        return view('auth.register');
    }
    // make the user register
    public function register(RegisterFormRequest $request){
        // form automatically validated with the dependency injection
        $data = $request->validated();
        $user = User::create([
            'fname'=> $data['fname'],
            'lname'=> $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password'=> $data['password']
        ]);
        if($user){
            Auth::login($user); // login user
            redirect('/');
        }
        return back()->with('error','Failed to create an account!');

    }
    // make them logout
    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
