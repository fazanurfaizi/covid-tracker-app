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
        <div class="comment-meta">
            <button class="comment-like">
                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
            </button>
            <button class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button>
            <button class="comment-reply" onclick='$("#reply-box{{ $comment->id }}").toggle();'><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>
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
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        @include('app.comments.index', [
            'comments' => $comment->replies
        ])
    </div>
@endforeach
