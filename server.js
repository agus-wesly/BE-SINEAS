const TOKEN = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIzMzViNTBiNWMzZjM2ZDY4NTMxNjFlYjUxZGVjY2RkZSIsIm5iZiI6MTczNjczMDg4OS4wNzQsInN1YiI6IjY3ODQ2OTA5MjI1NjAyM2RmZDRlNWNlOCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.7hMOkkiSKr7RuVdY-RLI7kYDjnAavJ1snmNLOFSdPeU'

const fs = require('node:fs');

const options = { method: 'GET', headers: { accept: 'application/json', authorization: `Bearer ${TOKEN}` } };
let currentPage = 1;
let expected_movie = 250;
const allData = [];
// Fetch 500 movie
// $table->id();
// $table->string('title');
// $table->string('slug');
// $table->text('desc');
// $table->string('url_film');
// $table->string('url_trailer');
// $table->date('date');
// $table->string('duration');
// $table->timestamps();
//
// Action, Adventure, Animation, Comedy, Crime
(async function() {
    try {
        while (expected_movie > 0) {
            const url = `https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=true&language=en-US&page=1&sort_by=vote_average.desc&without_genres=99,10755&vote_count.gte=200&page=${currentPage}`;
            const resp = await fetch(url, options);
            const data = await resp.json();
            // For each movie, make sure to get the thumbnail and video
            for (let i = 0; i < data.results.length; ++i) {
                if (expected_movie <= 0) throw new Error('Already full');
                const result = data.results[i];
                // Fetch video
                const filmUrl = await fetchVideo(result.id);

                // 'title' => fake()->name(),
                // 'desc' => fake()->text(),
                // 'date' => fake()->date(),
                // 'duration' => fake()->time(),
                // 'url_film' => "4e31983f-20f4-44dc-954a-edb1ce9b50bd",
                // 'url_trailer' => "4e31983f-20f4-44dc-954a-edb1ce9b50bd",
                // 'slug' => fake()->slug(),
                const currentData = {};
                currentData.id = result.id;
                currentData.title = result.title;
                currentData.slug = result.title;
                currentData.desc = result.overview;
                currentData.date = result.release_date;
                currentData.url_film = filmUrl;
                currentData.url_trailer = filmUrl;
                currentData.duration = '10';

                currentData.thumbnail = `https://image.tmdb.org/t/p/w500${result.poster_path}`;
                // Min : 1, Max: 5
                currentData.genre = Math.random() * (5 - 1 + 1) + 1;

                allData.push(currentData);
                console.log(`Done, Film Id :  ${currentData.id}`);
                --expected_movie;
            }
            ++currentPage;
        }
    } catch (e) {
        console.log(e);
    } finally {
        console.log("last movie : ", expected_movie);
        // 13
        console.log("last page : ", currentPage);
        await fs.writeFileSync('./output.json', JSON.stringify(allData));
    }

})();
async function fetchVideo(filmId) {
    const resp = await fetch(`https://api.themoviedb.org/3/movie/${filmId}/videos`, options);
    const data = await resp.json();
    for (let i = 0; i < data.results.length; ++i) {
        const result = data.results[i];
        if (result.site === 'YouTube') {
            return `https://www.youtube.com/watch?v=${result.key}`;
        }
    }
    return "";
}
// Reshape
// Write to local file
