@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="container">
    <div class="d-flex">
        <div class="row">
            <div class="d-none col-md-3 d-md-block col-lg-3 d-lg-block">
                <a href="{{ route('posts.search') }}" class="text-decoration-none"><p class="categories"><i class="fas fa-search mr-2"></i>記事を検索</p></a>
                @auth
                <!-- <a href="" class="text-decoration-none"><p class="categories"><i class="fas fa-stream mr-2"></i>タイムライン</p></a> -->
                <a href="{{ route('users.likes', Auth::user()->name) }}" class="text-decoration-none"><p class="categories"><i class="fas fa-heart mr-2"></i>お気に入り記事</p></a>
                <a href="{{ route('users.home', Auth::user()->name) }}" class="text-decoration-none"><p class="categories"><i class="fas fa-user mr-2"></i>プロフィール</p></a>
                @endauth
            </div>
            
            <div class="col-12 col-md-9 col-lg-6 px-1">
                <a href="/posts/new" class="btn btn-outline-success col-lg-12 my-3">投稿する</a>
                <div class="articles">
                @forelse ($posts as $post)
                    @include('articles.card')
                @empty
                <p>現在、記事が投稿されていません。</p>
                @endforelse
                </div>
                <p>{{ $posts->links() }}</p>
            </div>
            
            <div class="d-none d-md-none col-lg-3 d-lg-block"> 
                @auth
                <div class="card p-3 profile border-0">
                    <p class="m-0">
                        @if (Auth::user()->path === NULL)
                        <img src="/img/noimage.png" alt="image" class="user_image">
                        @else
                        <img src="{{ Auth::user()->path }}" alt="image" class="user_image">
                        @endif
                    </p>
                    <p class="m-0 pb-3 border-bottom"><a href="{{ route('users.home', Auth::user()->name) }}" class="text-muted">{{ Auth::user()->name }}</a></p>
                    <div class="d-flex justify-content-between">
                        <div class="post">
                            <p><a href="{{ route('users.index', Auth::user()->name) }}" class="text-decoration-none font-weight-bold text-dark">{{ Auth::user()->posts->count() }}</a></p>
                            <p><a href="{{ route('users.index', Auth::user()->name) }}" class="text-decoration-none text-dark">投稿</a></p>
                        </div>

                        <div class="follow">
                            <p><a href="{{ route('users.followings', Auth::user()) }}" class="text-decoration-none font-weight-bold text-dark">{{ Auth::user()->count_followings  }}</a></p>
                            <p><a href="{{ route('users.followings', Auth::user()) }}" class="text-decoration-none text-dark">フォロー</a></p>
                        </div>
                        <div class="follower">
                            <p><a href="{{ route('users.followers', Auth::user()) }}" class="text-decoration-none font-weight-bold text-dark">{{ Auth::user()->count_followers }}</a></p>
                            <p><a href="{{ route('users.followers', Auth::user()) }}" class="text-decoration-none text-dark">フォロワー</a></p>
                        </div>
                    </div>
                </div>
                @endauth
                @guest
                <div class="guest"></div>
                @endguest
                <div class="card ranking mt-2">
                    <p>フォロワーランキング</p>
                    @foreach ($users as $user)
                    @if ($user->followers_count >= 1)
                    <p class="users">
                        @if ($user->path === NULL)
                        {{ $loop->iteration . ' ' }} <img src="/img/noimage.png"><a href="{{ route('users.home', $user->name) }}" class="text-dark">{{ $user->name }}</a> <span class="follower-ranking_count">{{ $user->followers_count }}</span>
                        @else
                        {{ $loop->iteration . ' ' }} <img src="{{ $user->path }}"><a href="{{ route('users.home', $user->name) }}" class="text-dark">{{ $user->name }}</a><span class="follower-ranking_count">{{ $user->followers_count }}</span>
                        @endif
                    </p>
                    @endif
                    @endforeach
                </div>
                <div class="card ranking mt-2">
                    <p>タグランキング</p>
                    @foreach ($tags as $tag)
                    @if ($tag->posts_count >= 1)
                    <p class="tags">
                        {{ $loop->iteration . ' ' }}<a href="{{ route('tags.show', $tag->name) }}" class="text-dark">{{ $tag->name }}</a><span class="tags-ranking_count">{{ $tag->posts_count }}</span>
                    </p>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection