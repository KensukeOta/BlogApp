@extends('layouts.default')

@section('title', $selectUser->name . ' - BlogApp')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="text-center">
                    <p>現在のプロフィール画像</p>
                    @if ($selectUser->path === NULL)
                    <img src="img/noimage.png" alt="image" style="width: 30%; height: auto;">
                    @else
                    <img src="{{ asset('storage/' . $selectUser->path) }}" alt="image" style="width: 30%; height: auto;">
                    @endif
                    <p class="my-3">{{ $selectUser->name }}</p>
                    <div class="status d-flex justify-content-evenly">
                        <div class="post">
                            <p><a href="{{ action('UserController@index', $selectUser) }}" class="text-decoration-none font-weight-bold text-dark">{{ $selectUser->posts->count() }}</a></p>
                            <p><a href="{{ action('UserController@index', $selectUser) }}" class="text-decoration-none text-dark">投稿</a></p>
                        </div>
                        @if (Auth::user()->id === $selectUser->id)
                        <div class="like">
                            <p><a href="" class="text-decoration-none font-weight-bold text-dark">{{ $selectUser->likes->count() }}</a></p>
                            <p><a href="" class="text-decoration-none text-dark">お気に入り記事</a></p>
                        </div>
                        @endif
                        <div class="follow">
                            <p><a href="" class="text-decoration-none font-weight-bold text-dark">0</a></p>
                            <p><a href="" class="text-decoration-none text-dark">フォロー</a></p>
                        </div>
                        <div class="follower">
                            <p><a href="" class="text-decoration-none font-weight-bold text-dark">0</a></p>
                            <p><a href="" class="text-decoration-none text-dark">フォロワー</a></p>
                        </div>
                    </div>
                    @if (Auth::user()->id === $selectUser->id)
                    <a href="" class="btn btn-secondary">プロフィールを編集する</a>
                    @endif
                </div>         
            </div>
        </div>
    </div>
</div>
@endsection
