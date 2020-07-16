<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    //
    public function create(CommentRequest $request, Post $post)
    {
        $comment = new Comment;
        $form = $request->all();
        unset($form['_token']);
        $comment->fill($form)->save();
        return redirect()->action('PostController@show', $post);
    }
}
