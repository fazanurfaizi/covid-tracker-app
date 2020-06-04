<?php

namespace App\Observers;

use App\Models\Like;

class LikeObserver
{
    /**
     * Handle the like "creating" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function creating(Like $like)
    {
        if(is_null($like->user_id)) {
            $like->user_id = auth()->user()->id;
        }
    }
}
