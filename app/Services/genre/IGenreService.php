<?php

namespace App\Services\genre;


use Illuminate\Http\Request;

interface IGenreService
{
    public function getAllGenres(): object;
    public function getGenreWithPluck(): object;
    public function getGenreById(int $id): object;
    public function addGenre(Request $request): void;
    public function editGenre(Request $request, int $id): void;
    public function deleteGenre(int $id): void;
}
