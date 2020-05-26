<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{

    /**
     * Handle the tag "updated" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function updated(Tag $tag)
    {
        $tag->updated_at = date('Y-m-d G:i:s');
    }

    /**
     * Handle the tag "deleting" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function deleting(Tag $tag)
    {
        $tag->posts()->detach();
    }

}
