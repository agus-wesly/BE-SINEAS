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
        ];

        Genre::insert($genres);
    }
}
