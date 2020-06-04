<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{

    public function store(Request $request, Post $post) {
        return $post->like();
    }

    public function destroy(Post $post) {
        return $post->dislike();
    }

}
