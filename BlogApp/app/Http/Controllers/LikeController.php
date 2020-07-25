<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;

class LikeController extends Controller
{
    //
    public function like(Post $post, Request $request)
    {
        // いいねボタンを押した時、likesテーブルにuser_idカラムとpost_idカラムを追加
        $like = Like::create(['user_id' => $request->user_id, 'post_id' => $post->id]);

        return response()->json([]);
    }

    public function unlike(Post $post, Request $request)
    {
        // ログインユーザーのuser_idと、その記事のpost_idが同じレコードを見つける
        $like = Like::where('user_id', $request->user_id)->where('post_id', $post->id)->first();
        $like->delete();

        return response()->json([]);
    }
}
