<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts, 'user' => $user]);
    }

    public function new()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('posts.new', ['user' => $user]);
        } else {
            return redirect('/login');
        }
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
        $user = Auth::user();
        return view('posts.show', ['post' => $post, 'user' => $user]);
    }

    public function edit(Post $post)
    {
        $user = Auth::user();
        return view('posts.edit', ['post' => $post, 'user' => $user]);
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
