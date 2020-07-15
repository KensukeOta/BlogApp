@extends('layouts.default')

@section('title', $post->title . ' - BlogApp')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ nl2br(e($post->body)) }}</p>

<h3>コメント</h3>
<ul>
    @forelse ($post->comments as $comment)
    <li>{{ $comment->body }}</li>
    @empty
    <p>コメントがありません</p>
    @endforelse
</ul>
<form action="" method="post">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <textarea name="body" class="form-control my-3" placeholder="コメントを入力"></textarea>
    <input type="submit" value="コメントする" class="form-control btn btn-outline-success">
</form>
@endsection