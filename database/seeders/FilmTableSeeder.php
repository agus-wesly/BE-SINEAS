<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // Action, Adventure, Animation, Comedy, Crime
    public function run(): void
    {
        $content = file_get_contents('/tmp/output2.json', true);
        if (!$content) {
            error_log('Failed to read file');
            return;
        }
        $json = json_decode($content);
        foreach ($json as $k => $v) {
            // foreach ($v as $_k => $_v) {
            //     var_dump("$_k . $_v\n");
            // }

            $_v = json_decode(json_encode($v), true);
            $thumbnail = $_v['thumbnail'];
            $genre = $_v['genre'];
            unset($_v['thumbnail']);
            unset($_v['genre']);

            DB::table('films')->insert($_v);
            // Galleries
            DB::table('film_galleries')->insert([
                'film_id' => $_v['id'],
                'images' => $thumbnail,
                'type' => 'thumbnail',
            ]);
            // Details
            // Genres
            DB::table('film_genres')->insert([
                'film_id' => $_v['id'],
                'genre_id' => $genre
            ]);
        }
        return;
        Film::factory()->count(10)->create();
    }
}
