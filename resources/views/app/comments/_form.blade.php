<h5 class="card-header">Leave a Comment:</h5>
<div class="comment-box add-comment mb-0">
    <div class="row">
        <div class="col-1">
            <span class="commenter-pic">
                <img class="d-flex mr-3 rounded-circle" src="{{ asset('paper/img/logo-small.png') }}" alt="">
            </span>
        </div>
        <div class="col-11">
            <form action="{{ url("posts/{$post->id}/comment") }}" method="POST" id="comment-form">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="body" id="comment-body" rows="3" placeholder="Leave a comment"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Comment</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('#comment-form').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var data = $(this).serialize();

            $.ajax({
                url: url,
                type: method,
                data: data
            }).done(function(response) {
                console.log(response);
            })
        });
    </script>
@endpush
