<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Postingan;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Mail\PostLiked;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Postingan $post, Request $request)
    {
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Postingan $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }

    // public function likePost($postId)
    // {
    //     $post = Postingan::findOrFail($postId);
    //     $user = Auth::user();

    //     // Cek apakah user sudah like postingan
    //     $like = Like::where('user_id', $user->id)->where('post_id', $postId)->first();

    //     if ($like) {
    //         // Jika sudah like, maka unlike
    //         $like->delete();
    //     } else {
    //         // Jika belum like, maka like
    //         $newLike = new Like();
    //         $newLike->user_id = $user->id;
    //         $newLike->post_id = $postId;
    //         $newLike->save();

    //         // Buat notifikasi
    //         Notification::create([
    //             'user_id' => $post->user_id,
    //             'type' => 'like',
    //             'notifiable_id' => $newLike->id,
    //             'notifiable_type' => Like::class,
    //         ]);
    //     }

    //     return back();
    // }

    public function likePost($postId)
    {
        $post = Postingan::findOrFail($postId);
        $user = Auth::user();

        // Buat like baru
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();

        // Buat notifikasi
        Notification::create([
            'user_id' => $post->user_id,
            'type' => 'like',
            'notifiable_id' => $like->id,
            'notifiable_type' => Like::class,
        ]);

        return back();
    }
    
}
