@extends('layouts.default')

@section('title', Auth::user()->name . ' - BlogApp')

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
                    @if (Auth::user()->path === NULL)
                    <img src="/img/noimage.png" alt="image" style="width: 30%; height: auto;">
                    @else
                    <img src="{{ asset('storage/' . Auth::user()->path) }}" alt="image" style="width: 30%; height: auto;">
                    @endif
                    <p class="my-3">{{ Auth::user()->name }}</p>
                    <div class="status d-flex justify-content-evenly">

                    </div>  
                </div>         
            </div>
        </div>
    </div>
</div>
@endsection
