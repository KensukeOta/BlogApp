@extends('layouts.app')

@section('title', $selectUser->name . ' - BlogApp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-content">
                <div class="w-100">
                    <h2 class="title">Profile</h2>
                        @if ($selectUser->path === NULL)
                        <img src="/img/noimage.png" alt="image" style="width: 30%; height: auto;">
                        @else
                        <img src="{{ asset('storage/' . $selectUser->path) }}" alt="image" style="width: 30%; height: auto;">
                        @endif
                        <p class="my-3">{{ $selectUser->name }}</p>
                    <div class="status d-flex justify-content-between">
                        <div class="post align-middle">
                            <p><a href="{{ action('UserController@index', $selectUser) }}" class="text-decoration-none font-weight-bold text-dark text-center">{{ $selectUser->posts->count() }}</a></p>
                            <p><a href="{{ action('UserController@index', $selectUser) }}" class="text-decoration-none text-dark">投稿</a></p>
                        </div>

                        <div class="like">
                            <p><a href="{{ route('users.likes', $selectUser) }}" class="text-decoration-none font-weight-bold text-dark text-center">{{ $selectUser->likes->count() }}</a></p>
                            <p><a href="{{ route('users.likes', $selectUser) }}" class="text-decoration-none text-dark">お気に入り記事</a></p>
                        </div>

                        <div class="follow">
                            <p><a href="{{ action('UserController@followings', $selectUser) }}" class="text-decoration-none font-weight-bold text-dark text-center">{{ $selectUser->count_followings  }}</a></p>
                            <p><a href="{{ action('UserController@followings', $selectUser) }}" class="text-decoration-none text-dark">フォロー</a></p>
                        </div>
                        <div class="follower">
                            <p><a href="{{ action('UserController@followers', $selectUser) }}" class="text-decoration-none font-weight-bold text-dark text-center">{{ $selectUser->count_followers }}</a></p>
                            <p><a href="{{ action('UserController@followers', $selectUser) }}" class="text-decoration-none text-dark">フォロワー</a></p>
                        </div>
                    </div>

                    @auth
                    @if (Auth::user()->id !== $selectUser->id)
                    <follow-button class="ml-auto mb-3"
                    :initial-is-followed-by='@json($selectUser->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', $selectUser->name) }}"
                    >
                    </follow-button>  
                    @endif
                    @endauth

                    @guest 
                    <follow-button class="ml-auto mb-3"
                    :initial-is-followed-by='@json($selectUser->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', $selectUser->name) }}"
                    >
                    </follow-button> 
                    @endguest
                        
                    @auth
                    @if (Auth::user()->id === $selectUser->id)
                    <a href="{{ route('users.setting', Auth::user()) }}" class="btn btn-secondary">プロフィールを編集する</a>
                    @endif
                    @endauth
                </div> 
            </div>   
        </div>     
    </div>
</div>
@endsection
