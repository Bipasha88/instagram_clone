<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Repository\Repositories\FollowRepository;
use App\Repository\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $userRepo;
    private $followRepo;
    public function __construct(UserRepository $userRepository, FollowRepository $followRepository){
        $this->userRepo=$userRepository;
        $this->followRepo=$followRepository;
    }
    public function follow(Request $request){
        $this->validate($request,[
            'user_id' => 'required|exists:users,id',
        ]);

        $user = $this->userRepo->find($request->user_id);
        if ($user->account_type==1){
            $followed = $this->followRepo->create([
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
        $followers = $this->followRepo->with(['user'=>function($query){
            $query->select('id','username','name','email');
        }])
                    ->where('user_id',$request->user()->id)
                    ->get()
                    ->pluck('user');
   return response()->json(['followers'=>$followers]);
    }
}
