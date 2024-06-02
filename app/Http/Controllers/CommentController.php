<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Postingan;

class CommentController extends Controller
{
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
}
