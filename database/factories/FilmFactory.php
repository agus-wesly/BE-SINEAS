<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'desc' => fake()->text(),
            'date' => fake()->date(),
            'duration' => fake()->time(),
            'url_film' => fake()->url(),
            'url_trailer' => fake()->url(),
            'slug' => fake()->slug(),
        ];
    }
}
