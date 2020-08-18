<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;

class UserController extends Controller
{
    //
    public function home(User $user)
    {
        $selectUser = $user;
        return view('users.home', ['selectUser' => $selectUser]);
    }

    public function index(User $user)
    {
        $selectUser = $user;
        $posts = Post::latest()->where('user_id', $selectUser->id)->paginate(8);
        return view('users.index', ['selectUser' => $selectUser, 'posts' => $posts]);
    }

    public function likes(string $name)
    {
        $selectUser = User::where('name', $name)->first();
 
        $posts = $selectUser->likes->sortByDesc('created_at');
 
        return view('users.likes', [
            'selectUser' => $selectUser,
            'posts' => $posts,
        ]);
    }

    public function followings(string $name)
    {
        $selectUser = User::where('name', $name)->first();
 
        $followings = $selectUser->followings->sortByDesc('created_at');
 
        return view('users.followings', [
            'selectUser' => $selectUser,
            'followings' => $followings,
        ]);
    }
    
    public function followers(string $name)
    {
        $selectUser = User::where('name', $name)->first();
 
        $followers = $selectUser->followers->sortByDesc('created_at');
 
        return view('users.followers', [
            'selectUser' => $selectUser,
            'followers' => $followers,
        ]);
    }
    
    // フォローをされた側のメソッド
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
 
        return ['name' => $name];
    }
    
    //  フォローを外された側のメソッド
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
 
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
 
        $request->user()->followings()->detach($user);
 
        return ['name' => $name];
    }

    public function setting(ProfileRequest $request)
    {
        return view('users.setting');
    }

    
    // public function store(ProfileRequest $request)
    // {
    //     $originalImg = $request->path;
        
    //     if ($originalImg->isValid()) {
    //         $filePath = $originalImg->store('public');
    //         Auth::user()->path = str_replace('public/', '', $filePath);
    //         Auth::user()->save();
    //         return redirect()->route('users.setting', Auth::user())->with('success', '新しいプロフィール画像を登録しました');
    //     }
    // }

    public function store(Request $request)
  {
      Auth::user()->name = Auth::user()->name;
      Auth::user()->email = Auth::user()->email;
      //s3アップロード開始
      $image = $request->file('path');
      // バケットの`myprefix`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
      // アップロードした画像のフルパスを取得
      Auth::user()->path = Storage::disk('s3')->url($path);

      Auth::user()->save();

      return redirect()->route('users.setting', Auth::user())->with('success', '新しいプロフィール画像を登録しました');
  }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
