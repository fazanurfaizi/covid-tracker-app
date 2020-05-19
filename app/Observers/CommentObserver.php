<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    /**
     * Handle the comment "creating" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        if(is_null($comment->user_id)) {
            $comment->user_id = auth()->user()->id;
        }
    }

    /**
     * Handle the comment "updating" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function updating(Comment $comment)
    {
        $comment->updated_at = now();
    }

}
