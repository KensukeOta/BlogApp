@extends('layouts.default')

@section('title', '編集 - BlogApp')

@section('content')
<form action="{{ url('/posts', $post->id) }}" method="post">
    @csrf
    @method('PATCH')
    <input type="text" name="title" class="form-control my-3" placeholder="タイトル" value="{{ old('title', $post->title) }}">
    <textarea name="body" class="form-control my-3" placeholder="本文">{{ old('body', $post->body) }}</textarea>
    <input type="submit" value="更新する" class="form-control btn btn-outline-success">
</form>
@endsection