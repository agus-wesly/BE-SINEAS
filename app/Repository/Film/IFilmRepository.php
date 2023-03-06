<?php

namespace App\Repository\Film;

use App\Models\Film;

interface IFilmRepository
{
    public function getAllFilm();
    public function getFilmById(int $id);
    public function createFilm(array $data);
    public function createActorFilm(Film $film, string $name);
    public function createImageFilm(array $data);
    public function updateFilm(array $data, Film $film);
    public function deleteFilm(int $id);
    public function deleteImageFilm(int $id);
}
