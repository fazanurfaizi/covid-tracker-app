<?php

use Faker\Factory;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::all();

        for ($i = 0; $i < 50; $i++) {
            Like::create([
                'user_id' => $users->random()->id,
                'likeable_type' => rand(0, 1) === 1 ? Post::class : Comment::class,
                'likeable_id' => rand(1, 15)
            ]);
        }
    }
}
