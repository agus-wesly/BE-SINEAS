<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'image' => 'action.jpg',
            ],
            [
                'id' => 2,
                'name' => 'adventure',
                'image' => 'adventure.jpg',
            ],
        ];

        Genre::insert($genres);
    }
}
