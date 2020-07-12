<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;

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

    public function create(PostRequest $request)
    {
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

    public function update(PostRequest $request, Post $post)
    {
        $form = $request->all();
        unset($form['_token']);
        $post->fill($form)->save();
        return redirect('/');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
