<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index(Request $request) {
        $posts = Post::when($request->search, function($query) use ($request) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%");
        })->published()->latest()->paginate(6);

        return view('app.posts.index', compact('posts'));
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();

        return view('app.posts.show', compact('post'));
    }

}
