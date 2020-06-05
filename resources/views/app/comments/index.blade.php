@foreach ($comments as $comment)
    <div class="comment-box">
        <span class="commenter-pic">
            <img class="d-flex mr-3 rounded-circle" src="{{ asset('paper/img/logo-small.png') }}" alt="">
        </span>
        <span class="commenter-name">
            <p>{{ $comment->user->name }}</p>
            <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
        </span>
        <p class="comment-txt more">{{ $comment->body }}</p>
        <div class="comment-meta mb-3">
            <button class="comment-reply" onclick='$("#reply-box{{ $comment->id }}").toggle();'>
                <i class="fa fa-reply-all" aria-hidden="true"></i> Reply
            </button>
            <like
                :likes-count="{{ count($comment->likes) }}"
                :liked="{{ json_encode($comment->isLiked()) }}"
                :item-id="{{ $comment->id }}"
                item-type="comments"
                :logged-in="{{ json_encode(Auth::check()) }}"
                :user-id="{{ Auth::check() ? json_encode(Auth::user()->id) : '0' }}"
            ></like>
            <form class="dropdown-item" action="{{ url("posts/comment/{$comment->id}") }}" id="delete-comment-{{ $comment->id }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a onclick="document.getElementById('delete-comment-{{ $comment->id }}').submit();" class="ml-2">
                <i class="fa fa-trash"></i>
            </a>
        </div>
        <div class="comment-box add-comment reply-box m-0" id="reply-box{{ $comment->id }}">
            <div class="row">
                <div class="col-1">
                    <span class="commenter-pic">
                        <img class="d-flex mr-3 rounded-circle" src="{{ asset('paper/img/logo-small.png') }}" alt="">
                    </span>
                </div>
                <div class="col-10">
                    <form action="{{ url("posts/{$post->id}/comment") }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                        <div class="form-group">
                            <textarea class="form-control" name="body" id="comment-body" rows="3" placeholder="Leave a comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Comment</button>
                        <button type="reset" class="btn btn-default" onclick='$("#reply-box{{ $comment->id }}").toggle();'>Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        @include('app.comments.index', [
            'comments' => $comment->replies
        ])
    </div>
@endforeach
