@extends('layouts.default')

@section('title', $post->title . ' - BlogApp')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ nl2br(e($post->body)) }}</p>

<h3 class="my-5">コメント</h3>
<ul>
    @forelse ($post->comments as $comment)
    <div class="border-bottom">
        <p class="font-weight-bold">kensuke</p>
        <p>{{ $comment->body }}</p>
    </div>
    @empty
    <p>コメントがありません</p>
    @endforelse
</ul>
<form action="" method="post">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <textarea name="body" class="form-control my-3" placeholder="コメントを入力"></textarea>
    @error('body')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <input type="submit" value="コメントする" class="form-control btn btn-outline-success">
</form>
@endsection