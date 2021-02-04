<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function follow(Request $request){
        $this->validate($request,[
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::where('id',$request->user_id)->first();
        if ($user->account_type==1){
            $followed = Follow::create([
                'user_id' => $request->user_id,
                'follower_id' => Auth::id(),
            ]);

            return response()->json([
                'follow' => $followed
            ]);

        }
        else{
            return response()->json([
                'message'=>'This is private account.This User needs to accept before following.'
            ]);
        }

    }

    public function followers(Request $request){
        $followers = Follow::with(['user'=>function($query){
            $query->select('id','username','name','email');
        }])
                    ->where('user_id',$request->user()->id)
                    ->get()
                    ->pluck('user');
   return response()->json(['followers'=>$followers]);
    }
}
