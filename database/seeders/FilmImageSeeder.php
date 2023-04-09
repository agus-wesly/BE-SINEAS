<?php

namespace Database\Seeders;

use App\Models\FilmGallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FilmGallery::factory()->count(10)->create();
    }
}
