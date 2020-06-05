<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

trait Likeable {

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLiked() {
        if(Auth::check()) {
            return $this->likes->where('user_id', auth()->user()->id)->isNotEmpty();
        }
        return false;
    }

    public function like($userId) {
        if($this->likes()->where('user_id', $userId)->doesntExist()) {
            $like = new Like();
            $like->user_id = $userId;
            return $this->likes()->save($like);
        }
    }

    public function dislike($userId) {
        return $this->likes()->where('user_id', $userId)->get()->each->delete();
    }

}

?>
