@extends('layouts.default')

@section('title', $post->title . ' - BlogApp')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ nl2br(e($post->body)) }}</p>

<h3 class="my-5">コメント</h3>
<ul>
    @forelse ($post->comments as $comment)
    <div class="border-bottom">
        <p class="font-weight-bold">{{ $comment->user->name }}</p>
        <p>{{ $comment->body }}</p>
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
@endsection