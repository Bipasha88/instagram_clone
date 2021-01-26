<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'dob'=> 'required',
            'username'=> 'required',
            'gender'=> 'required',
            'phone'=> 'required',

        ]);

        $user= User::create($request->all());

        return response()->json($user);
    }

    public function login(Request $request){
        $request->validate([

            'email' => 'required|email|exits:users,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt([
            'email' =>  $request->email,
            'password' => $request->password,
        ])){
            $user = Auth::user();

            $token = $user->creatToken($user->email.'-'.now());

            return response()->json([
                'token' => $token->access_token
            ]);
        } else{
            return response()->json([

                'message' => 'Invalid email or password',
            ]);
        }

    }
}
