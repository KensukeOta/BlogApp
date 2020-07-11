@extends('layouts.default')

@section('title', $post->title . ' - BlogApp')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ nl2br(e($post->body)) }}</p>
@endsection