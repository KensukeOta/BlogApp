@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="container" style="padding: 32px 64px 0; background: #fff; height: 100vh;">
    <div class="row">
        @if (Auth::check())
        <p class="text-center">ようこそ、{{ $user->name }}さん！</p>
        @endif
        <a href="/posts/new" class="btn btn-outline-success my-3">投稿する</a>
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
                @foreach($post->tags as $tag)
                    @if($loop->first)
                    <div class="card-body pt-0 pb-4 pl-0">
                        <div class="card-text line-height">
                    @endif
                        <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
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
        @empty
        <p>現在、記事が投稿されていません。</p>
        @endforelse
    </div>
<p>{{ $posts->links() }}</p>
</div>
@endsection