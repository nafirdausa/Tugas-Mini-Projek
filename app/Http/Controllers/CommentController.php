<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id',
            'parent_comment_id' => 'nullable|exists:comments,id',
        ]);

        // Create new comment
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id,
            'body' => $request->body,
        ]);

        return back();
    }
}

