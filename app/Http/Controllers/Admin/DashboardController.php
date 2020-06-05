<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;

class DashboardController extends Controller
{

    public function index() {
        $data = [
            'totalPosts' => Post::count(),
            'totalTags' => Tag::count(),
            'totalCategories' => Category::count(),
            'totalUsers' => User::count()
        ];
        return view('admin.dashboard.index', $data);
    }

}
