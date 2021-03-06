@extends('layouts.default')

@section('title', $selectUser->name . 'さんの記事一覧' . ' - ' .'BlogApp')

@section('content')
<div class="container">
    <div class="row">
        <p class="text-center mt-3">{{ $selectUser->name }}さんの投稿</p>
        @forelse ($posts as $post)
            @include('articles.card')
        @empty
        <p>現在、記事が投稿されていません。</p>
        @endforelse
    </div>
    <p>{{ $posts->links() }}</p>
</div>
<script src="/js/main.js"></script>
@endsection