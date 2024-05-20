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
        return view('test');
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
    ]);

    return redirect()->back();
   }

}
