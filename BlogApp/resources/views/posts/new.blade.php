@extends('layouts.default')

@section('title', '新規作成 - BlogApp')

@section('content')
<form action="" method="post">
    @csrf
    <input type="text" name="title" class="form-control my-3" placeholder="タイトル" value="{{ old('title') }}">
    @error('title')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <textarea name="body" class="form-control my-3" placeholder="本文">{{ old('body') }}</textarea>
    @error('body')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    <input type="submit" value="投稿する" class="form-control btn btn-outline-success">
</form>
@endsection