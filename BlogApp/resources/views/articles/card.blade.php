<div class="card col-12">
    <!-- <img src="" class="card-img-top" alt="..."> -->
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title font-weight-bold"><a href="{{ action('PostController@show', $post) }}" class="text-dark">{{ $post->title }}</a></h5>
            <article-like
            :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
            :initial-count-likes='@json($post->count_likes)' 
            :authorized='@json(Auth::check())'
            endpoint="{{ route('posts.like', ['post' => $post]) }}"    
            >
            </article-like>
        </div>
        <p class="card-text">by <a href="{{ action('UserController@home', $post->user->name) }}" class="text-dark">{{ $post->user->name }}</a></p>
        @foreach($post->tags as $tag)
            @if($loop->first)
            <div class="card-body pt-0 pb-4 pl-0">
                <div class="card-text line-height">
            @endif
                <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                    {{ $tag->hashtag }}
                </a>
            @if($loop->last)
                </div>
            </div>
            @endif
        @endforeach
        @if (Auth::check())
            @if (Auth::user()->id === $post->user_id)
            <a href="{{ action('PostController@edit', $post) }}" class="btn btn-success">編集</a>
            @endif
            @if (Auth::user()->id === $post->user_id)
            <a href="#" class="btn btn-success del" data-id="{{ $post->id }}">削除</a>
            @endif
            <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</div>