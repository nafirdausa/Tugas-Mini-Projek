<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\FlareClient\View;
use App\Models\Postingan;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\For_;

class ProjekController extends Controller
{
    // Halaman home
    // public function index(User $user){
    //     $posts = Postingan::all();
    //     $user = User::all();
    //     // $user = Auth::user();
    //     return view('home', ['posts' => $posts, 'user' => $user]);
    // } 
    
    public function index()
    {
        $posts = Postingan::all();
        if (Auth::check()) {
            $userId = auth()->id();
            
            $suggestions = User::where('id', '!=', $userId)
                ->whereDoesntHave('FollowUser', function ($query) use ($userId) {
                    $query->where('follower_id', $userId);
                })
                ->get();
        } else {
            $suggestions = User::orderBy('created_at', 'desc')
                ->get()->toArray();
            // dd($suggestions);
        }
        
        return view('home', ['posts' => $posts, 'suggestions' => $suggestions]);
    }
    
    public function indexFollowing()
    {
        $user = Auth::user();

        // Initialize $posts and $suggestions
        $posts = collect();
        $suggestions = collect();

        if (Auth::check()) {
            // Get the IDs of users followed by the authenticated user
            $followingIds = $user->follows()->pluck('id');

            // Get the posts from the users being followed
            $posts = Postingan::whereIn('user_id', $followingIds)->latest()->get();

            // Get user suggestions
            $userId = auth()->id();
            $suggestions = User::where('id', '!=', $userId)
                ->whereDoesntHave('FollowUser', function ($query) use ($userId) {
                    $query->where('follower_id', $userId);
                })
                ->get();
        } else {
            // If user is not authenticated, get all posts
            $posts = Postingan::latest()->get();

            // Get user suggestions (for non-authenticated users)
            $suggestions = User::orderBy('created_at', 'desc')
                ->get();
        }

        return view('home', ['posts' => $posts, 'suggestions' => $suggestions]);
    }

}
