<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{

    /**
     * Handle the post "creating" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        if(is_null($post->user_id)) {
            $post->user_id = auth()->user()->id;
        }
        $post->slug = $post->createSlug($post->title);
    }

    /**
     * Handle the post "updating" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {
        $post->updated_at = now();
    }

    /**
     * Handle the post "deleting" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        $post->comments->each->delete();
        $post->tags->each->detach();
        $post->like->each->delete();
    }

}
