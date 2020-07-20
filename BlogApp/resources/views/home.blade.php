@extends('layouts.default')

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
                    @if ($user->path === NULL)
                    <img src="img/noimage.png" alt="image" style="width: 30%; height: auto;">
                    @else
                    <img src="{{ asset('storage/' . $user->path) }}" alt="image" style="width: 30%; height: auto;">
                    @endif
                    <p class="my-3">{{ $user->name }}</p>
                    <div class="status d-flex justify-content-evenly">
                        <div class="post">
                            <p><a href="" class="text-decoration-none text-dark">0</a></p>
                            <p><a href="" class="text-decoration-none text-dark">投稿</a></p>
                        </div>
                        <div class="like">
                            <p><a href="" class="text-decoration-none text-dark">0</a></p>
                            <p><a href="" class="text-decoration-none text-dark">お気に入り記事</a></p>
                        </div>
                        <div class="follow">
                            <p><a href="" class="text-decoration-none text-dark">0</a></p>
                            <p><a href="" class="text-decoration-none text-dark">フォロー</a></p>
                        </div>
                        <div class="follower">
                            <p><a href="" class="text-decoration-none text-dark">0</a></p>
                            <p><a href="" class="text-decoration-none text-dark">フォロワー</a></p>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </div>
</div>
@endsection
