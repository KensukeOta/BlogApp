@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="row">
    <p class="text-center">{{ $selectUser->name }}さんの投稿</p>
    @forelse ($selectUser->posts as $post)
    <div class="card col-md-4">
        <!-- <img src="" class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">by {{ $post->user->name }}</p>
            <a href="{{ action('PostController@show', $post) }}" class="btn btn-success">記事を見る</a>
            @if (Auth::check())
                @if (Auth::user()->id === $post->user_id)
                <a href="{{ action('PostController@edit', $post) }}" class="btn btn-success">編集</a>
                @endif
                @if (Auth::user()->id === $post->user_id)
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
<script src="/js/main.js"></script>
@endsection