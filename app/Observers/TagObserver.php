<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{

    /**
     * Handle the tag "updating" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function updating(Tag $tag)
    {
        $tag->updated_at = now();
    }

    /**
     * Handle the tag "deleting" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function deleting(Tag $tag)
    {
        $tag->posts->each->detach();
    }

}
