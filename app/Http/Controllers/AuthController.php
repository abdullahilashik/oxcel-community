<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    // make the login happen
    public function login(LoginFormRequest $request){
        $validated = $request->validated();
        // if(Auth::attempt($validated)){
        //     return redirect('/');
        // }

        if (Auth::attempt($validated)) {
            // Generate a random 6-digit OTP
            $otp = rand(100000, 999999);

            // Store the OTP and the user's ID in the session
            Session::put('otp', $otp);
            Session::put('user_id', Auth::id());

            // Send the OTP to the user (e.g., via email)
            Mail::to(Auth::user()->email)->send(new OtpMail($otp));

            // Log out the user to prevent automatic login until OTP verification
            Auth::logout();

            return redirect()->route('verify.otp');
        }

        return back()->with('error', 'Failed to login');
    }

    public function verifyOtpForm(){
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|integer']);

        $userId = Session::get('user_id');
        $otp = Session::get('otp');

        if ($otp == $request->otp) {
            // Clear OTP data from the session
            Session::forget('otp');
            Session::forget('user_id');

            // Log in the user
            Auth::loginUsingId($userId);

            return redirect()->route('posts');
        }

        return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
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
