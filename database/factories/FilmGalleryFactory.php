<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilmGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $filmId = \App\Models\Film::all()->random()->id;

        return [
            'film_id' => $filmId,
            'images' => "https://img.freepik.com/premium-photo/film-frame-mock-up-template-with-image-text-placeholder-movie-frames-pencil-drawn-sketch-illustration-background_568886-21385.jpg",
            'type' => fake()->randomElement(['thumbnail', 'background']),
        ];
    }
}
