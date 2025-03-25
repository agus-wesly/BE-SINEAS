<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $images = [
            "https://movies-proxy.vercel.app/ipx/f_webp&s_1220x659/tmdb/qfAfE5auxsuxhxPpnETRAyTP5ff.jpg",
            "https://movies-proxy.vercel.app/ipx/f_webp&s_1220x659/tmdb/cVh8Af7a9JMOJl75ML3Dg2QVEuq.jpg",
            "https://movies-proxy.vercel.app/ipx/f_webp&s_1220x659/tmdb/zo8CIjJ2nfNOevqNajwMRO6Hwka.jpg",
            "https://movies-proxy.vercel.app/ipx/f_webp&s_1220x659/tmdb/rOMLLMGgDgGG6XeT3P8sUdUb8nl.jpg"
        ];
        return [
            'title' => fake()->name(),
            'description' => fake()->text(),
            'image' => $images[rand(0,3)],
            'url_link' => fake()->url(),
            'expired_date' => fake()->date(),
            'status' => fake()->boolean(),
        ];
    }
}
