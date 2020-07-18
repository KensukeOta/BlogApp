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

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="text-center">
                    <p>現在のプロフィール画像</p>
                    @if ($user->path === NULL)
                    <img src="img/noimage.png" alt="image" style="width: 30%; height: auto;">
                    @else
                    <img src="{{ asset('storage/' . $user->path) }}" alt="image" style="width: 30%; height: auto;">
                    @endif

                    <form action="/home" method="post" enctype="multipart/form-data">
                        <p class="mt-3">プロフィール画像の変更</p>
                        @csrf 
                        <div>
                            <input type="file" name="path">
                            <input type="submit" value="変更する">
                        </div>
                    </form>
                    @error('path')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
