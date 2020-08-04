@extends('layouts.default')

@section('title', Auth::user()->name . ' - BlogApp')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="text-center">
                    <p>現在のプロフィール画像</p>
                    @if (Auth::user()->path === NULL)
                    <img src="/img/noimage.png" alt="image" style="width: 30%; height: auto;">
                    @else
                    <img src="{{ asset('storage/' . Auth::user()->path) }}" alt="image" style="width: 30%; height: auto;">
                    @endif
                    <p class="my-3">{{ Auth::user()->name }}</p>

                    <form action="{{ route('users.setting', Auth::user()) }}" method="post" enctype="multipart/form-data">
                        <p>プロフィール画像の変更</p>
                        @csrf 
                        <input type="file" name="path">
                        <input type="submit" value="変更する">
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
