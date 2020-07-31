<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    //
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();
        $posts = Post::orderBy('created_at', 'desc');
        $user = Auth::user();

        return view('tags.show', ['tag' => $tag, 'posts' => $posts, 'user' => $user]);
    }
}
