<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class FilmGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\FilmGenre::factory()->count(10)->create();

        $data = [
            [
                "name" => 'Action',
                "description" => "Action",
                "slug" => "action",
                "image" => "-"
            ],
            [
                "name" => 'Adventure',
                "description" => "Adventure",
                "slug" => "adventure",
                "image" => "-"
            ],
            [
                "name" => 'Animation',
                "description" => "Animation",
                "slug" => "animation",
                "image" => "-"
            ],
            [
                "name" => 'Comedy',
                "description" => "Comedy",
                "slug" => "comedy",
                "image" => "-"
            ],
            [
                "name" => 'Crime',
                "description" => "Crime",
                "slug" => "crime",
                "image" => "-"
            ],
            [
                "name" => 'Documentary',
                "description" => "Documentary",
                "slug" => "documentary",
                "image" => "-"
            ],
            [
                "name" => 'Drama',
                "description" => "Drama",
                "slug" => "drama",
                "image" => "-"
            ],
            [
                "name" => 'Family',
                "description" => "Family",
                "slug" => "family",
                "image" => "-"
            ],
            [
                "name" => 'Fantasy',
                "description" => "Fantasy",
                "slug" => "fantasy",
                "image" => "-"
            ],
            [
                "name" => 'History',
                "description" => "History",
                "slug" => "history",
                "image" => "-"
            ],
            [
                "name" => 'Horror',
                "description" => "Horror",
                "slug" => "horror",
                "image" => "-"
            ],
            [
                "name" => 'Music',
                "description" => "Music",
                "slug" => "music",
                "image" => "-"
            ],
            [
                "name" => 'Mystery',
                "description" => "Mystery",
                "slug" => "mystery",
                "image" => "-"
            ],
            [
                "name" => 'Romance',
                "description" => "Romance",
                "slug" => "romance",
                "image" => "-"
            ],
            [
                "name" => 'Science Fiction',
                "description" => "Science Fiction",
                "slug" => "science-fiction",
                "image" => "-"
            ],
            [
                "name" => 'TV Movie',
                "description" => "TV Movie",
                "slug" => "tv-movie",
                "image" => "-"
            ],
            [
                "name" => 'Thriller',
                "description" => "Thriller",
                "slug" => "thriller",
                "image" => "-"
            ],
            [
                "name" => 'War',
                "description" => "War",
                "slug" => "war",
                "image" => "-"
            ],
            [
                "name" => 'Western',
                "description" => "Western",
                "slug" => "western",
                "image" => "-"
            ]
            ];
        

        foreach ($data as $key => $value) {
            Genre::create($value);
        }

    }
}
