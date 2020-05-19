<?php

use Faker\Factory;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::select('id')->get();
        $categories = Category::select('id')->get();
        $tags = Tag::all();
        $images = File::allFiles(public_path('uploads/posts/'));

        for ($i = 0; $i < 15; $i++) {
            Post::create([
                'title' => $faker->sentence,
                'body' => $faker->paragraph(10),
                'image' => $images[rand(0, 5)]->getFilename(),
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'is_published' => rand(0, 1),
            ])->tags()->sync($tags->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
