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

   
    public function seeBookmark()
    {
        $user = auth()->user();
        $posts = $user->bookmarks()->with('user')->get();
        return view('bookmark', ['posts' => $posts, 'user' => $user]);
    }

    public function bookmark(Postingan $post, Request $request)
    {
        if ($post->bookmarkBy($request->user())) {
            return response(null, 409);
        }

        $post->bookmarks()->attach($request->user()->id);
        return back();
    }

    public function unbookmark(Postingan $post, Request $request)
    {
        $request->user()->bookmarks()->detach($post->id);
        return back();
    }
}
