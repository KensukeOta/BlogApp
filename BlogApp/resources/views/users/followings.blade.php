@extends('layouts.default')

@section('title', $selectUser->name . 'さんのフォロー中のユーザー' . ' - ' . 'BlogApp')

@section('content')
<div class="container">
    <p class="text-center mt-3">{{ $selectUser->name }}さんのフォロー中のユーザー</p>
    @forelse ($followings as $person)
    <div class="card col">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title m-0">
                    <span>
                        @if ($person->path === NULL)
                        <img src="/img/noimage.png" alt="image" class="user_image">
                        @else
                        <img src="{{ $person->path }}" alt="image" class="user_image">
                        @endif
                    </span><a href="{{ route('users.home', $person->name) }}" class="text-dark">{{ $person->name }}</a>
                </h5>
                @auth
                @unless (Auth::user()->name === $person->name)
                <follow-button
                :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('users.follow', $person->name) }}"
                ></follow-button>
                @endunless
                @endauth

                @guest 
                <follow-button
                :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('users.follow', $person->name) }}"
                ></follow-button>
                @endguest
            </div>
        </div>
    </div>
    @empty
    <p>フォロー中のユーザーはいません</p>
    @endforelse
</div>
<script src="/js/main.js"></script>
@endsection