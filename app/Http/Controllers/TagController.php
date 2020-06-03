<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;

class TagController extends Controller
{

    public function index(Request $request, $slug) {
        $tag = Tag::where('slug', $slug)->first();
        $categories = Category::all();

        $posts = Post::whereHas('tags', function($query) use ($tag) {
            return $query->whereIn('tag_id', $tag);
        })->when($request->search, function($query) use ($request) {
            $search = $request->search;
            return $query->where('title', 'like', "%$search%");
        })->when($request->category, function($query) use ($request) {
            $category_slug = $request->category;
            $category = Category::where('slug', $category_slug)->first();
            return $query->where('category_id', $category->id);
        })->published()->latest()->withCount('likes')->paginate(6);

        return view('app.tags.posts', compact('posts', 'categories'));
    }

}
