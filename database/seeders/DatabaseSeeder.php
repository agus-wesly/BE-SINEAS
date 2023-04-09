<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolesTableSeeder::class,
            UserSeeder::class,
            GenreTableSeeder::class,
            FilmTableSeeder::class,
            FilmSellingPriceSeeder::class,
            FilmSellingSeeder::class,
            TransactionSeeder::class,
            FilmViewSeeder::class,
            FilmImageSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
