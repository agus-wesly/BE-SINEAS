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
            'url_film' => "https://iframe.mediadelivery.net/embed/110856/4e31983f-20f4-44dc-954a-edb1ce9b50bd?autoplay=true&preload=true",
            'url_trailer' => "https://iframe.mediadelivery.net/embed/110856/4e31983f-20f4-44dc-954a-edb1ce9b50bd?autoplay=true&preload=true",
            'slug' => fake()->slug(),
        ];
    }
}
