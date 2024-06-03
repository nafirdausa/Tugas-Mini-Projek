<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\FlareClient\View;
use App\Models\Postingan;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;


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
        // Mendapatkan semua postingan
        $posts = Postingan::all();
        if (Auth::check()) {
            $userId = auth()->id();
            
            // Mendapatkan semua pengguna kecuali pengguna saat ini dan yang sudah diikuti
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
        
        // Mengirim data ke view
        return view('home', ['posts' => $posts, 'suggestions' => $suggestions]);
    }
    
    

}
