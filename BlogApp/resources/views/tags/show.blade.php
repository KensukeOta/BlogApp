@extends('layouts.default')

@section('title', $tag->hashtag . ' - BlogApp')

@section('content')
<div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->posts->count() }}件
        </div>
      </div>
    </div>
<div>

    <div class="container">
        <div class="row">
            @foreach ($tag->posts as $post)
                @include('articles.card')
            @endforeach
        </div>
    </div>
@endsection