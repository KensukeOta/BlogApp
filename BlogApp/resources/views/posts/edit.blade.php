@extends('layouts.default')

@section('title', '編集 - BlogApp')

@section('content')
<div class="container" style="padding: 32px; background: #fff; height: 100vh;">
    <form action="{{ url('/posts', $post->id) }}" method="post">
        @csrf
        @method('PATCH')
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="text" name="title" class="form-control my-3" placeholder="タイトル" value="{{ old('title', $post->title) }}">
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <article-tags-input
        :initial-tags='@json($tagNames ?? [])'
        > 
        </article-tags-input>
        @error('tags')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <textarea name="body" class="form-control my-3" rows="16" placeholder="本文">{{ old('body', $post->body) }}</textarea>
        @error('body')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <input type="submit" value="更新する" class="form-control btn btn-outline-success">
    </form>
</div>
@endsection