<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{

    public function index(Request $request) {
        $posts = Post::when($request->search, function($query) use ($request) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%");
        })->published()->latest()->paginate(6);

        $categories = Category::all();

        return view('app.posts.index', compact('posts', 'categories'));
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();

        return view('app.posts.show', compact('post'));
    }

}
