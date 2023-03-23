<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $film_selling = \App\Models\FilmSelling::with(['sellingPrice', 'film'])->get()->random();
//        dd($film_selling->film->id);
//        dd($film_selling->film->title);
//        dd($film_selling->sellingPrice->price);
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'film_selling_id' => $film_selling->id,
            'film_id' => $film_selling->film->id,
            'code' => $this->faker->uuid,
            'payment_status' => $this->faker->randomElement(['pending', 'success', 'failed']),
            'payment_method' => $this->faker->randomElement(['gopay', 'ovo', 'dana']),
            'payment_date' => $this->faker->date(),
            'watch_expired_date' => $this->faker->date(),
            'title_film' => $film_selling->film->title,
            'total' => $film_selling->sellingPrice->price,
            'tax' => 1000,
            'subtotal' => $film_selling->sellingPrice->price + 1000,
            'transaction_date' => $this->faker->date(),
        ];
    }
}
