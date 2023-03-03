<?php

namespace App\Repository\genre;

use App\Models\Genre;

interface IGenreRepository
{
    public function getAllGenres(): object;
    public function getGenreWithPluck(): object;
    public function getGenreById(int $id): Genre;
    public function createGenre(array $data): void;
    public function updateGenre(array $data, Genre $genre): void;
    public function deleteGenre(Genre $genre): void;
}
