<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return back();
    }
}
