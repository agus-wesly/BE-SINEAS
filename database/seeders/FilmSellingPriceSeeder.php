<?php

namespace Database\Seeders;

use App\Models\FilmSellingPrice;
use Illuminate\Database\Seeder;

class FilmSellingPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FilmSellingPrice::factory()->count(10)->create();
    }
}
