<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
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

    public function index(User $user)
    {
        $selectUser = $user;
        $posts = Post::where('user_id', $selectUser->id)->orderBy('created_at', 'desc')->paginate(2);
        return view('users.index', ['selectUser' => $selectUser, 'posts' => $posts]);
    }
    
    public function store(ProfileRequest $request)
    {
        $originalImg = $request->path;
        
        if ($originalImg->isValid()) {
            $filePath = $originalImg->store('public');
            Auth::user()->path = str_replace('public/', '', $filePath);
            Auth::user()->save();
            return redirect('/home')->with('success', '新しいプロフィールを登録しました');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
