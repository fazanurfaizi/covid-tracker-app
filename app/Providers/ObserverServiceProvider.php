<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Like;
use App\Observers\CategoryObserver;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Observers\TagObserver;
use App\Observers\UserObserver;
use App\Observers\LikeObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Tag::observe(TagObserver::class);
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
        // Like::observe(LikeObserver::class);
    }
}
