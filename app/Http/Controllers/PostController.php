<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{

    public function index(Request $request) {
        $categories = Category::all();
        $posts = Post::when($request->search, function($query) use ($request) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%");
        })->when($request->category, function($query) use ($request) {
            $category_name = $request->category;
            $category = Category::where('name', $category_name)->first();
            return $query->where('category_id', $category->id);
        })->published()->latest()->withCount('likes')->paginate(6);

        return view('app.posts.index', compact('posts', 'categories'));
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->withCount('likes')->first();
        $relatedPosts = $post->relatedPosts;

        return view('app.posts.show', compact('post', 'relatedPosts'));
    }

    public function like(Request $request) {
        $post = Post::find($request->id);
        return $post->like();
    }

}
