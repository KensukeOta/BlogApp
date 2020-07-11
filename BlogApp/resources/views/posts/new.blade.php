@extends('layouts.default')

@section('title', '新規作成 - BlogApp')

@section('content')
<form action="" method="post">
    @csrf
    <input type="text" name="title" class="form-control my-3" placeholder="タイトル">
    <textarea name="body" class="form-control my-3" placeholder="本文"></textarea>
    <input type="submit" value="投稿する" class="form-control btn btn-outline-success">
</form>
@endsection