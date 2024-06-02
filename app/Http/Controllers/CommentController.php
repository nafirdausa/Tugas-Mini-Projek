<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Postingan;
use App\Models\LikeComent;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'text_comment' => 'required',
            'post_id' => 'required|exists:postingans,id',
            'parent_comment_id' => 'nullable|exists:comments,id',
        ]);

        // Create new comment
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id,
            'text_comment' => $request->text_comment,
        ]);

        return back();
    }

    public function show($id)
    {
        $post = Postingan::with('comments.user')->findOrFail($id);
        return view('detail-postingan', compact('post'));
    }

    // public function likeComment($postId)
    // {
    //     $post = Postingan::findOrFail($postId);

    //     $like = LikeComent::firstOrCreate([
    //         'user_id' => auth()->id(),
    //         'post_id' => $post->id,
    //     ]);

    //     return back();
    // }

    // public function unlikeComment($postId)
    // {
    //     $post = Postingan::findOrFail($postId);

    //     $like = LikeComent::where('user_id', auth()->id())
    //                 ->where('post_id', $post->id)
    //                 ->first();

    //     if ($like) {
    //         $like->delete();
    //     }

    //     return back();
    // }

    public function likeComment(Comment $comment, Request $request)
    {
        if ($comment->likedCommentBy($request->user())) {
            return response(null, 409);
        }

        $comment->likesComment()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function unlikeComment(Comment $comment, Request $request)
    {
        $request->user()->likesComment()->where('comment_id', $comment->id)->delete();

        return back();
    }

}
