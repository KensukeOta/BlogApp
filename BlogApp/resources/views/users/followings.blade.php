@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<p class="text-center">{{ $selectUser->name }}さんのフォロー中のユーザー</p>
@forelse ($followings as $person)
<div class="card col">
    <!-- <img src="" class="card-img-top" alt="..."> -->
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title">{{ $person->name }}</h5>
            <follow-button
            :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())'
            endpoint="{{ route('users.follow', $person->name) }}"
            ></follow-button>
        </div>
    </div>
</div>
@empty
<p>フォロー中のユーザーはいません</p>
@endforelse
<script src="/js/main.js"></script>
@endsection