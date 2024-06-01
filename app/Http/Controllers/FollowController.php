<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Postingan;
use Illuminate\Support\Facades\Auth;


class FollowController extends Controller
{
    // public function follow(User $user)
    // {
    //     $currentUser = Auth::user();
    //     $currentUser->following()->attach($user->id);

    //     return back();
    // }

    // public function unfollow(User $user)
    // {
    //     $currentUser = Auth::user();
    //     $currentUser->following()->detach($user->id);

    //     return back();
    // }


    // public function follow(User $user, Request $request)
    // {
    //     if ($user->followBy($request->user())) {
    //         return response(null, 409);
    //     }

    //     $user->following()->create([
    //         'user_id' => $request->user()->id,
    //     ]);

    //     return back();
    // }

    // public function unfollow(User $user, Request $request)
    // {
    //     $request->user()->following()->where('user_id', $user->id)->delete();

    //     return back();
    // }



    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    // public function follow(User $user, Request $request)
    // {
    //     if ($user->followBy($request->user())) {
    //         return response(null, 409);
    //     }

    //     $user->follows()->create([
    //         'user_id' => $request->user()->id,
    //     ]);

    //     return back();
    // }

    // public function unfollow(User $user, Request $request)
    // {
    //     $request->user()->likes()->where('user_id', $user->id)->delete();

    //     return back();
    // }


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
    
    // public function follow(User $user, Request $request)
    // {
    //     if (!$user->followBy($request->user())) {
    //         $user->follows()->create([
    //             'follower_id' => $request->user()->id,
    //             'followed_id' => $user->id,
    //         ]);
    //     }
    
    //     return back();
    // }
    
    // public function unfollow(User $user, Request $request)
    // {
    //     $request->user()->follows()->where('followed_id', $user->id)->delete();
    
    //     return back();
    // }
    
    
        
    // public function showSuggestions()
    // {
    //     $userId = auth()->id();
    //     $suggestions = User::where('id', '!=', $userId)
    //         ->whereDoesntHave('followUsers', function ($query) use ($userId) {
    //             $query->where('follower_id', $userId);
    //         })
    //         ->get();
    
    //     return view('home', compact('suggestions'));
    // }
    
}
