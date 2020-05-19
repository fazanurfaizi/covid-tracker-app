<?php

namespace App\Traits;

use App\Models\Like;

trait Likeable {

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like() {
        if($this->likes()->where('user_id', auth()->user()->id)->doesntExist()) {
            return $this->likes()->create([
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function isLiked() {
        return $this->likes->where('user_id', auth()->user()->id)->isNotEmpty();
    }

    public function dislike() {
        return $this->likes->where('user_id', auth()->user()->id)->get()->each()->delete();
    }

}

?>
