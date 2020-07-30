@extends('layouts.default')

@section('title', $post->title . ' - BlogApp')

@section('content')
    <div class="container" style="padding: 32px; background: #fff; height: 100vh;">
    <h1>{{ $post->title }}</h1>
    <p>by <img src="{{ asset('storage/' . $post->user->path) }}" style="width: 32px; height: 32px; border-radius: 50%;" class="mr-2">{{ $post->user->name }}</p>
    <p class="mt-5">{{ nl2br(e($post->body)) }}</p>

    <article-like
    :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
    :initial-count-likes='@json($post->count_likes)' 
    :authorized='@json(Auth::check())'
    endpoint="{{ route('posts.like', ['post' => $post]) }}"    
    >
    </article-like>

    <h3 class="mb-2 mt-5 font-weight-bold" style="font-size: 18px;">コメント</h3>
    <ul>
        @forelse ($post->comments as $comment)
        <div class="border-bottom py-3">
            <p class="font-weight-bold"><img src="{{ asset('storage/' . $comment->user->path) }}" style="width: 32px; height: 32px; border-radius: 50%;" class="mr-2">{{ $comment->user->name }}</p>
            <p style="font-size: 14px;" class="mb-0">{{ $comment->body }}</p>
        </div>
        @empty
        <p>コメントがありません</p>
        @endforelse
    </ul>
    @if (Auth::check())
    <form action="" method="post">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <textarea name="body" class="form-control my-3" placeholder="コメントを入力">{{ old('body') }}</textarea>
        @error('body')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <input type="submit" value="コメントする" class="form-control btn btn-outline-success">
    </form>
    @else
        <a href="/login" class="btn btn-success">ログイン</a>
    @endif
</div>
@endsection