<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentLikeController extends Controller
{
    public function store(Request $request, Comment $comment) {
        return $comment->like($request->userId);
    }

    public function destroy(Request $request, Comment $comment) {
        return $comment->dislike($request->userId);
    }
}
