<?php

namespace Database\Seeders;

use App\Models\FilmView;
use Illuminate\Database\Seeder;

class FilmViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FilmView::factory()->count(10)->create();
    }
}
