@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="container">
    <div class="d-flex">
        <div class="row">
            <div class="col-12 col-lg-8 px-1">
                <a href="/posts/new" class="btn btn-outline-success col-lg-12 my-3">投稿する</a>
                @forelse ($posts as $post)
                    @include('articles.card')
                @empty
                <p>現在、記事が投稿されていません。</p>
                @endforelse
                <p>{{ $posts->links() }}</p>
            </div>
            <div class="d-none col-lg-4 d-lg-block">  
                <div class="card">
                    <div class="card-title">こんにちは</div>
                    <div class="card-text">こんにちは</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection