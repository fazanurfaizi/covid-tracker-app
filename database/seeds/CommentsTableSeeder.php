<?php

use Faker\Factory;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $users = User::all();
        $faker = Factory::create();

        foreach ($posts as $post) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                // Main Comment
                $comment = Comment::create([
                    'user_id' => $users->random()->id,
                    'post_id' => $post->id,
                    'body' => $faker->sentence
                ]);

                // Replies
                $reply = Comment::create([
                    'user_id' => $users->random()->id,
                    'post_id' => $post->id,
                    'body' => $faker->sentence,
                    'parent_id' => $comment->id
                ]);
            }
        }
    }
}
