@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="row">
    <a href="/posts/new" class="btn btn-outline-success my-3">投稿する</a>
    @forelse ($posts as $post)
    <div class="card col-md-4">
        <!-- <img src="" class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->body }}</p>
            <a href="#" class="btn btn-success">記事を見る</a>
        </div>
    </div>
    @empty
    <p>現在、記事が投稿されていません。</p>
    @endforelse
</div>
@endsection