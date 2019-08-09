<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::all();

        return view('customer.post.index', ['posts' => $posts]);
    }

        /**
     * Display the specified resource.	
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::find($id);
        if (!$post) {
            return back()->with('status', 'Post not found!');
        }
        return view('customer.post.show', ['post' => $post]);
    }
}
