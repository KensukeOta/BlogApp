<div class="card article p-0">
    <!-- <img src="" class="card-img-top" alt="..."> -->
    <div class="card-body p-3">
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
        <div class="d-flex justify-content-between">
            <p class="card-text text-muted m-0">by <a href="{{ action('UserController@home', $post->user->name) }}" class="text-muted">{{ $post->user->name }}</a></p>
            @if (Auth::check())
                @if (Auth::user()->id === $post->user_id)
                <a href="{{ action('PostController@edit', $post) }}" title="編集"><i class="fas fa-edit"></i></a>
                @endif
                @if (Auth::user()->id === $post->user_id)
                <a href="#" class="del" data-id="{{ $post->id }}" title="削除"><i class="far fa-trash-alt"></i></a>
                @endif
                <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
            <p class="text-muted m-0">{{ $post->created_at }}</p>
        </div>
    </div>
</div>
