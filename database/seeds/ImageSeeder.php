<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('uploads/posts/');

        if(!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        File::cleanDirectory($path);

        $faker = Factory::create();

        for ($i = 0; $i < 15; $i++) {
            $faker->image($path, $width = 1024, $height = 512);
        }
    }
}
