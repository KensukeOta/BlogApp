<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
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
        $comments = Comment::all();
        return view('posts.show', ['post' => $post, 'user' => $user, 'comments' => $comments]);
    }

    public function edit(Post $post)
    {
        $user = Auth::user();
        if ($user->id === $post->user_id) {
            return view('posts.edit', ['post' => $post, 'user' => $user]);
        } else {
            return redirect('/');
        }
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

    public function search(Request $request)
    {
        $user = Auth::user();
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return view('posts.search', ['posts' => $posts, 'user' => $user]);
    }

    public function result(SearchRequest $request)
    {
        $user = Auth::user();
        $posts = Post::where('title', 'LIKE' , '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(2);
        return view('posts.search', ['user' => $user, 'posts' => $posts]);
    }

    public function like(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        $post->likes()->attach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }

    public function unlike(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }
}
