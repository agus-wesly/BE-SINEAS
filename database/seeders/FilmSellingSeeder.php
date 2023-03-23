<?php

namespace Database\Seeders;

use App\Models\FilmSelling;
use Illuminate\Database\Seeder;

class FilmSellingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FilmSelling::factory()->count(5)->create();
    }
}
