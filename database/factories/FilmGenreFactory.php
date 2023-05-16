<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FilmGenre>
 */
class FilmGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $filmId = \App\Models\Film::all()->random()->id;
            $genreId = \App\Models\Genre::all()->random()->id;
        } while (\App\Models\FilmGenre::where('film_id', $filmId)->where('genre_id', $genreId)->exists());

        return [
            'film_id' => $filmId,
            'genre_id' => $genreId,
        ];
    }
}
