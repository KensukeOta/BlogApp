@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/home" method="post" enctype="multipart/form-data">
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
