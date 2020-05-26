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
        $post->slug = $post->createSlug($post->title);
    }

    /**
     * Handle the post "Updated" Event.
     *
     * @param  \App\Models\Post $post
     * @return void
     */
    public function updated(Post $post) {
        $post->updated_at = date('Y-m-d G:i:s');
    }

}
