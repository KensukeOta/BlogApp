<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function new()
    {
        return view('posts.new');
    }

    public function create(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post = new Post;
        $form = $request->all();
        unset($form['_token']);
        $post->fill($form)->save();
        return redirect('/');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, Post::$rules);
        $form = $request->all();
        unset($form['_token']);
        $post->fill($form)->save();
        return redirect('/');
    }
}
