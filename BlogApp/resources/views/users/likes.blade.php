@extends('layouts.default')

@section('title', $selectUser->name . 'さんのお気に入りの記事' . ' - ' . 'BlogApp')

@section('content')
<div class="container">
    <div class="row">
        <p class="text-center">{{ $selectUser->name }}さんのお気に入り記事</p>
        @forelse ($selectUser->likes as $post)
            @include('articles.card')
        @empty
        <p>お気に入りの記事がありません</p>
        @endforelse
    </div>
</div>
<script src="/js/main.js"></script>
@endsection