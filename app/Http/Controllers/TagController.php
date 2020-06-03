<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;

class TagController extends Controller
{

    public function index($slug) {
        $tag = Tag::where('slug', $slug)->first();
        $posts = Post::whereHas('tags', function($query) use ($tag) {
            $query->whereIn('tag_id', $tag);
        })->get();
        return view('app.tags.posts', compact('posts'));
    }

}
