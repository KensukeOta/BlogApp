@extends('layouts.default')

@section('title', $tag->hashtag . ' - BlogApp')

@section('content')
<div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->posts->count() }}件
        </div>
      </div>
    </div>
<div>

    <div class="container">
        <div class="row">
            @foreach ($tag->posts as $post)
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
                    @foreach($post->tags as $tag)
                        @if($loop->first)
                        <div class="card-body pt-0 pb-4 pl-0">
                            <div class="card-text line-height">
                        @endif
                            <a href="" class="border p-1 mr-1 mt-1 text-muted">
                                {{ $tag->hashtag }}
                            </a>
                        @if($loop->last)
                            </div>
                        </div>
                        @endif
                    @endforeach
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
            @endforeach
        </div>
    </div>
@endsection