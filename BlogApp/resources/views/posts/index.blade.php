@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="container" style="padding: 32px 64px 0; background: #fff; height: 100vh;">
    <div class="row">
        @if (Auth::check())
        <p class="text-center">ようこそ、{{ Auth::user()->name }}さん！</p>
        @endif
        <a href="/posts/new" class="btn btn-outline-success my-3">投稿する</a>
        @forelse ($posts as $post)
            @include('articles.card')
        @empty
        <p>現在、記事が投稿されていません。</p>
        @endforelse
    </div>
<p>{{ $posts->links() }}</p>
</div>
@endsection