<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FilmSelling>
 */
class FilmSellingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $film_id = \App\Models\Film::all()->random()->id;

        $film_selling = \App\Models\FilmSelling::where('film_id', $film_id)->first();
        if ($film_selling) {
            $film_id =$film_selling->film_id;
            $film_selling = \App\Models\FilmSelling::where('film_id', $film_id)->first();
        }
        return [
            'film_id' => $film_id,
            'film_selling_price_id' => \App\Models\FilmSellingPrice::all()->random()->id,
            'name' => $this->faker->name,
            'expired_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['active', 'comingsoon', 'expired']),
            'is_free' => $this->faker->boolean,
        ];
    }

//     Generate unique film_id and film_selling_price_id
     public function unique(): self
        {

            return $this->state(function (array $attributes) {
                $film_id = \App\Models\Film::all()->random()->id;
                $film_selling = \App\Models\FilmSelling::where('film_id', $film_id)->first();
                if ($film_selling) {
                    $film_id =$film_selling->film_id;
                    $film_selling = \App\Models\FilmSelling::where('film_id', $film_id)->first();
                }
                return [
                    'film_id' => $film_id,
                ];
            });
        }
}
