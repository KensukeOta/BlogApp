@extends('layouts.default')

@section('title', $selectUser->name . 'さんのフォロー中のユーザー' . ' - ' . 'BlogApp')

@section('content')
<div class="container">
    <p class="text-center mt-3">{{ $selectUser->name }}さんのフォロー中のユーザー</p>
    @forelse ($followings as $person)
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
    <p>フォロー中のユーザーはいません</p>
    @endforelse
</div>
<script src="/js/main.js"></script>
@endsection