<?php

namespace App\Services\Film;

use App\Models\Film;
use Illuminate\Http\Request;

interface IFilmService
{
    public function getAllFilm(): object;
    public function getFilmById(int $id): Film;
    public function addFilm(Request $request);
    public function updateFilm(array $data, int $filmId): bool|null;
    public function deleteFilm(int $id): bool|null;
    public function addImageToFilm(array $data, int $filmId): bool|null;
    public function deleteImageFromFilm(int $filmId): bool|null;
}
