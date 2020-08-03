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
        $posts = Post::orderBy('created_at', 'desc')->paginate(8);
        return view('posts.index', ['posts' => $posts,]);
    }

    public function new()
    {
        if (Auth::check()) {
            $allTagNames = Tag::all()->map(function ($tag) {
                return ['text' => $tag->name];
            });
            return view('posts.new', ['allTagNames' => $allTagNames]);
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
        $comments = Comment::all();
        return view('posts.show', ['post' => $post,'comments' => $comments]);
    }

    public function edit(Post $post)
    {
        $tagNames = $post->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        if (Auth::user()->id === $post->user_id) {
            return view('posts.edit', ['post' => $post,'tagNames' => $tagNames, 'allTagNames' => $allTagNames]);
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
        $posts = Post::orderBy('created_at', 'desc')->paginate(8);
        return view('posts.search', ['posts' => $posts,]);
    }

    public function result(SearchRequest $request)
    {
        $posts = Post::where('title', 'LIKE' , '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(8);
        return view('posts.search', ['posts' => $posts]);
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
