<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class APIAuthController extends Controller
{
    /**
     * Login via the api. takes a request, validates with a custom validation request.
     * @param \App\Http\Requests\LoginFormRequest $request
     * @return void
     */
    public function login(LoginFormRequest $request){
        $validated = $request->validated(); // get the validate data
        if(Auth::attempt($validated)){
            // validation attemp with the validated form request.
            $user = User::where('email', $validated['email'])->first();
            $token = $user->createToken(Auth::user()->email);
            $user['token'] = $token->plainTextToken;
            return response()->json($user);
        }
        return response()->json([
            'message'=> 'Invalid credentials',
            'errors'=> []
        ]);
    }
    /**
     * Summary of register
     * @param \App\Http\Requests\RegisterFormRequest $request
     * @return void
     */
    public function register(RegisterFormRequest $request){
        $validated = $request->validated();
        // register the validated data into the user table
        $user = User::create($validated);
        $token = $user->createToken($user->email);
        $user['token'] = $token->plainTextToken;
        return response()->json($user);
    }
    // logout route
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            "message" => "Logged out"
        ]);
    }
    // password reset route
    // password reset email route
}
