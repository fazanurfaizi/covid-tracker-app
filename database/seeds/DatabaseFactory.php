<?php

use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\Seeder;

class DatabaseFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Tag::class, 10)->create();
        factory(Category::class, 10)->create();
        factory(Post::class, 10)->create();
        factory(Comment::class, 30)->create();
        factory(Like::class, 50)->create();

        $tags = Tag::all();

        Post::all()->each(function($post) use ($tags) {
            $post->tags()->attach(
                $tags->random()->pluck('id')->toArray()
            );
        });
    }
}
