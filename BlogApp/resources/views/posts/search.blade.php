@extends('layouts.default')

@section('title', '検索 - BlogApp')

@section('content')
<div class="container" style="padding: 32px; background: #fff; height: 100vh;">
    <div class="row">
        <form action="" method="post">
            @csrf
            <input type="search" name="search" class="form-control my-3" placeholder="検索" value="{{ old('search') }}">
            @error('search')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </form>
        @forelse ($posts as $post)
            @include('articles.card')
        @empty
        <p>記事が見つかりませんでした</p>
        @endforelse
    </div>
</div>
<p>{{ $posts->links() }}</p>
<script src="/js/main.js"></script>
@endsection