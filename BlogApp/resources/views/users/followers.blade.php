@extends('layouts.default')

@section('title', $selectUser->name . 'さんのフォロワー' . ' - ' . 'BlogApp')

@section('content')
<div class="container">
    <p class="text-center mt-3">{{ $selectUser->name }}さんのフォロワー</p>
    @forelse ($followers as $person)
    <div class="card col">
        <!-- <img src="" class="card-img-top" alt="..."> -->
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title m-0">
                    <span>
                        @if ($person->path === NULL)
                        <img src="/img/noimage.png" alt="image" class="user_image">
                        @else
                        <img src="{{ asset('storage/' . $person->path) }}" alt="image" class="user_image">
                        @endif
                    </span>
                    <a href="{{ route('users.home', $person->name) }}" class="text-dark">{{ $person->name }}</a>
                </h5>
                @if (Auth::check())
                @unless (Auth::user()->name === $person->name)
                <follow-button
                :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('users.follow', $person->name) }}"
                ></follow-button>
                @endunless
                @endif

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
    <p>フォロワーがいません</p>
    @endforelse
</div>
<script src="/js/main.js"></script>
@endsection