@extends('layouts.default')

@section('title', 'BlogApp')

@section('content')
<div class="row">
    <a href="/posts/new" class="btn btn-outline-success my-3">投稿する</a>
    <div class="card col-md-4">
        <!-- <img src="" class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-success">Go somewhere</a>
        </div>
    </div>
</div>
@endsection