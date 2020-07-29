@extends('layouts.default')

@section('title', '検索 - BlogApp')

@section('content')
<div class="row">
    <form action="" method="post">
        @csrf
        <input type="search" name="search" class="form-control my-3" placeholder="検索" value="{{ old('search') }}">
        @error('search')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </form>
    @forelse ($posts as $post)
    <div class="card col-md-4">
        <!-- <img src="" class="card-img-top" alt="..."> -->
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{{ $post->title }}</h5>
                <article-like
                :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
                :initial-count-likes='@json($post->count_likes)' 
                :authorized='@json(Auth::check())'
                endpoint="{{ route('posts.like', ['post' => $post]) }}"    
                >
                </article-like>
            </div>
            <p class="card-text">by {{ $post->user->name }}</p>
            <a href="{{ action('PostController@show', $post) }}" class="btn btn-success">記事を見る</a>
            @if (Auth::check())
                @if ($user->id === $post->user_id)
                <a href="{{ action('PostController@edit', $post) }}" class="btn btn-success">編集</a>
                @endif
                @if ($user->id === $post->user_id)
                <a href="#" class="btn btn-success del" data-id="{{ $post->id }}">削除</a>
                @endif
                <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </div>
    </div>
    @empty
    <p>記事が見つかりませんでした</p>
    @endforelse
</div>
<p>{{ $posts->links() }}</p>
<script src="/js/main.js"></script>
@endsection