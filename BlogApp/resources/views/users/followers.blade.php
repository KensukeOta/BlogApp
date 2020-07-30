@extends('layouts.default')

@section('title', $selectUser->name . 'さんのフォロワー' . ' - ' . 'BlogApp')

@section('content')
<p class="text-center">{{ $selectUser->name }}さんのフォロワー</p>
@forelse ($followers as $person)
<div class="card col">
    <!-- <img src="" class="card-img-top" alt="..."> -->
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">{{ $person->name }}</h5>
            @if (Auth::check())
            @unless (Auth::user()->name === $person->name)
            <follow-button
            :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())'
            endpoint="{{ route('users.follow', $person->name) }}"
            ></follow-button>
            @endunless
            @endif
        </div>
    </div>
</div>
@empty
<p>フォロワーがいません</p>
@endforelse
<script src="/js/main.js"></script>
@endsection