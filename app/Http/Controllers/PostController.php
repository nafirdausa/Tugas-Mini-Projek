<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function posting(){
        return view('posting');
    }
    public function postRequest(Request $request, User $user){
        $validator = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'required|string',
        ],[
            'image.required' => 'Kolom image harus diisi',
            'caption.required' => 'Kolom caption harus diisi',
        ]);

        $imagePath = $request->file('image')->store('product_image', 'public');

        Postingan::create([
            'user_id' => auth()->user()->id, // Get the authenticated user's ID
            'image' => $imagePath,
            'caption' => $request->caption,
        ]);

        return redirect()->route('home', ['user' => $user]);
    }

    public function detailPosting($id) {
        $post = Postingan::findOrFail($id); // Fetch the post by ID
        return view('detail-posting', ['post' => $post]);
    }

    public function show($id)
    {
        $post = Postingan::with('comments.user')->findOrFail($id);
        return view('detail-postingan', compact('post'));
    }
    
}
