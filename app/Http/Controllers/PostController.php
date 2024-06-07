<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * For fetching post data
     */
    public function index() {

        $posts = Post::with('user', 'likes')->orderBy('created_at', 'desc')->paginate(5);

        return view('users.posts.index', compact('posts'));
    }

   /**
    * for storing post data
    */
   public function store(Request $request) {

    $this->validate($request, [
        'content' => ['required', 'string', 'min:3', 'max:1000']
    ]);

    Post::create([
        'content' => $request->content,
        'user_id' => auth()->user()->id,
    ]);

    return redirect()->back();
   }

   /**
    * Updating a post instance
   */
   public function update(Request $request, Post $post) {

    $this->validate($request, [
        'content' => ['required', 'min:3', 'max:1000']
    ]);

    $post->update([
        'content' => $request->content,
    ]);

    return redirect()->back();
   }

   /**
    * Delete post instance
    */
   public function delete(Post $post) {

    $post->likes()->delete();

    $post->delete();

    return redirect()->back();
   }

}
