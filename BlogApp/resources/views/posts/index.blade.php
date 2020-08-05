@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="container">
    <div class="d-flex">
        <div class="row">
            <div class="col-12 col-lg-8 px-1">
                <a href="/posts/new" class="btn btn-outline-success col-lg-12 my-3">投稿する</a>
                @forelse ($posts as $post)
                    @include('articles.card')
                @empty
                <p>現在、記事が投稿されていません。</p>
                @endforelse
                <p>{{ $posts->links() }}</p>
            </div>
            
            <div class="d-none col-lg-4 d-lg-block"> 
                @auth
                <div class="card p-3 profile border-0">
                    <p class="m-0"><img src="{{ asset('storage/' . Auth::user()->path) }}" alt="image" class="user_image"></p>
                    <p class="m-0 pb-3 border-bottom"><a href="{{ action('UserController@home', Auth::user()->name) }}" class="text-muted">{{ Auth::user()->name }}</a></p>
                    <div class="d-flex justify-content-evenly">
                        <div class="post">
                            <p><a href="{{ action('UserController@index', Auth::user()) }}" class="text-decoration-none font-weight-bold text-dark">{{ Auth::user()->posts->count() }}</a></p>
                            <p><a href="{{ action('UserController@index', Auth::user()) }}" class="text-decoration-none text-dark">投稿</a></p>
                        </div>

                        <div class="like">
                            <p><a href="{{ route('users.likes', Auth::user()) }}" class="text-decoration-none font-weight-bold text-dark">{{ Auth::user()->likes->count() }}</a></p>
                            <p><a href="{{ route('users.likes', Auth::user()) }}" class="text-decoration-none text-dark">お気に入り記事</a></p>
                        </div>

                        <div class="follow">
                            <p><a href="{{ action('UserController@followings', Auth::user()) }}" class="text-decoration-none font-weight-bold text-dark">{{ Auth::user()->count_followings  }}</a></p>
                            <p><a href="{{ action('UserController@followings', Auth::user()) }}" class="text-decoration-none text-dark">フォロー</a></p>
                        </div>
                        <div class="follower">
                            <p><a href="{{ action('UserController@followers', Auth::user()) }}" class="text-decoration-none font-weight-bold text-dark">{{ Auth::user()->count_followers }}</a></p>
                            <p><a href="{{ action('UserController@followers', Auth::user()) }}" class="text-decoration-none text-dark">フォロワー</a></p>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection