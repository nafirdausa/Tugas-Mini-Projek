<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\User;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // Bookmark Method
    public function seeBookmark(User $user){
        $posts = $user->bookmarkedPosts()->with('user')->get();
        // return view('bookmark', ['posts' => $posts]);
        
        // $posts = Postingan::all();
        return view('bookmark', ['posts' => $posts, 'user' => $user]);
    }

    public function bookmark(Postingan $post, Request $request)
    {
        if ($post->bookmarkBy($request->user())) {
            return response(null, 409);
        }

        $post->bookmarks()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function unbookmark(Postingan $post, Request $request)
    {
        $request->user()->bookmarks()->where('post_id', $post->id)->delete();

        return back();
    }
}
