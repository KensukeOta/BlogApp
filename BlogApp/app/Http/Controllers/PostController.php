<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Tag;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        $posts = Post::orderBy('created_at', 'desc')->paginate(8);
        return view('posts.index', ['posts' => $posts, 'user' => $user]);
    }

    public function new()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $allTagNames = Tag::all()->map(function ($tag) {
                return ['text' => $tag->name];
            });
            return view('posts.new', ['user' => $user, 'allTagNames' => $allTagNames]);
        } else {
            return redirect('/login');
        }
    }

    public function create(PostRequest $request, Post $post)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();
        $request->tags->each(function ($tagName) use ($post) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag);
        });
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
        $tagNames = $post->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        if ($user->id === $post->user_id) {
            return view('posts.edit', ['post' => $post, 'user' => $user, 'tagNames' => $tagNames, 'allTagNames' => $allTagNames]);
        } else {
            return redirect('/');
        }
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();

        $post->tags()->detach();
        $request->tags->each(function ($tagName) use ($post) {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $post->tags()->attach($tag);
        });
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
