<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //
    public function show(User $user)
    {
        $selectUser = $user;
        return view('home', ['selectUser' => $selectUser]);
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
