<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Politik', 'Hukum & Kriminal', 'Peristiwa',
            'Asean', 'Asia Pasifik', 'Timur Tengah', 'Eropa Amerika',
            'Keuangan', 'Energi', 'Bisnis', 'Makro',
            'Sepakbola', 'F1', 'Moto Gp', 'Baket',
            'Sains', 'Telekomunikasi', 'Otomotif',
            'Film', 'Musik',
            'Kesehatan', 'Wisata'
        ];

        foreach ($tags as $name) {
            Tag::create([
                'name' => $name,
                'slug' => str_slug($name)
            ]);
        }
    }
}
