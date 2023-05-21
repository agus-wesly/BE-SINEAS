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
            'url_film' => "4e31983f-20f4-44dc-954a-edb1ce9b50bd",
            'url_trailer' => "4e31983f-20f4-44dc-954a-edb1ce9b50bd",
            'slug' => fake()->slug(),
        ];
    }
}
