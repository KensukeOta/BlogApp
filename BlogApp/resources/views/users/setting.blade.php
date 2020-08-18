@extends('layouts.app')

@section('title', Auth::user()->name . ' - BlogApp')

@section('content')
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">プロフィール画像</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">パスワード再設定</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row justify-content-center mt-3">
                <div class="col-md-8">
                    <div class="login-content">
                        <div class="w-100">
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <p class="text-center">現在のプロフィール画像</p>
                            @if (Auth::user()->path === NULL)
                            <img src="/img/noimage.png" alt="image" style="width: 30%; height: auto;">
                            @else
                            <img src="{{ Auth::user()->path }}" alt="image" style="width: 30%; height: auto;">
                            @endif
                            <p class="my-3">{{ Auth::user()->name }}</p>

                            <form action="{{ route('users.setting', Auth::user()) }}" method="post" enctype="multipart/form-data" class="mx-auto">
                                <p>プロフィール画像の変更</p>
                                @csrf 
                                <input type="file" name="path">
                                <input type="submit" value="変更する">
                            </form>
                            @error('path')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div> 
                    </div>       
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('status'))
                    <div class="card-text alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="login-content">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <h2 class="title">Password Reset</h2>
                            <div class="input-div one">
                                <div class="i">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="div">
                                    <h5>Email Address</h5>
                                    <input type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="row">
                                <input type="submit" class="submit" value="Send Password Reset Link">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
    </div>
</div>
@endsection
