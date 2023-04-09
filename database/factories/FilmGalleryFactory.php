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

        do {
            $filmId = \App\Models\Film::all()->random()->id;
            $filmImage = \App\Models\FilmGallery::where('film_id', $filmId)->count();
        } while ($filmImage < 2);


        return [
            'film_id' => $filmId,
            'images' => fake()->imageUrl(),
            'type' => fake()->randomElement(['thumbnail', 'background']),
        ];
    }
}
