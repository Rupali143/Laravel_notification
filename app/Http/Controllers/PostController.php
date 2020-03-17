<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Events\PostPublished;

class PostController extends Controller
{
    /**
     * Saves a new post to the database
     */
    public function store(Request $request) {
//        $this->validate($request, [
//            'message' => 'required|string'
//        ]);

        $data = $request->only(['title', 'description']);

        //  save post and assign return value of created post to $post array
        $post = Post::create($data);
        //dd($post);
        event(new PostPublished($post));
        //dd($post);
        // return post as response, Laravel automatically serializes this to JSON
        return response($post, 201);
    }
}
