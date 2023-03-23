<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilmViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaction = \App\Models\Transaction::with(['film','user'])->get()->random();
        return [
            'user_id' => $transaction->user->id,
            'film_id' => $transaction->film->id,
            'transaction_id' => $transaction->id,
        ];
    }
}
