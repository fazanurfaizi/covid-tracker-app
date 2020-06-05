<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->parent_id = $request->parent_id ?? null;
        $post->comments()->save($comment);

        return redirect()->back();
    }

    public function destroy(Comment $comment) {
        $this->authorize('delete', $comment);
        $comment->delete();

        return redirect()->back();
    }

}
