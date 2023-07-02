<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            [
                'id' => 1,
                'name' => 'action',
                'slug' => 'action',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 2,
                'name' => 'adventure',
                'slug' => 'adventure',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 3,
                'name' => 'animation',
                'slug' => 'animation',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 4,
                'name' => 'comedy',
                'slug' => 'comedy',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 5,
                'name' => 'crime',
                'slug' => 'crime',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 6,
                'name' => 'documentary',
                'slug' => 'documentary',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 7,
                'name' => 'drama',
                'slug' => 'drama',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 8,
                'name' => 'family',
                'slug' => 'family',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 9,
                'name' => 'fantasy',
                'slug' => 'fantasy',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 10,
                'name' => 'history',
                'slug' => 'history',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 11,
                'name' => 'horror',
                'slug' => 'horror',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 12,
                'name' => 'music',
                'slug' => 'music',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
            [
                'id' => 13,
                'name' => 'mystery',
                'slug' => 'mystery',
                'image' => 'https://dummyimage.com/600x400/000/fff',
            ],
        ];

        Genre::insert($genres);
    }
}
