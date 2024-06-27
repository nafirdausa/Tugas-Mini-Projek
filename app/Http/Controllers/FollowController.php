<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Postingan;
use App\Models\Follow;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


class FollowController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function follow(User $user, Request $request)
    {
        if (!$user->followBy($request->user())) {
            $request->user()->follows()->create([
                'followed_id' => $user->id,
            ]);
        }
    
        return back()->with('message', 'User followed successfully');
    }
    
    public function unfollow(User $user, Request $request)
    {
        $request->user()->follows()->where('followed_id', $user->id)->delete();
    
        return back()->with('message', 'User unfollowed successfully');
    }


    public function followUser($userId)
    {
        $userToFollow = User::findOrFail($userId);
        $user = Auth::user();

        // Buat follow baru
        $follow = new Follow();
        $follow->follower_id = $user->id;
        $follow->followed_id = $userToFollow->id;
        $follow->save();

        // Buat notifikasi
        Notification::create([
            'user_id' => $userToFollow->id,
            'type' => 'follow',
            'notifiable_id' => $follow->id,
            'notifiable_type' => Follow::class
        ]);

        return back();
    }
    
}
