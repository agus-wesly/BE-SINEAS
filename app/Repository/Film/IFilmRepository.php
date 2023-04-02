<?php

namespace App\Repository\Film;

use App\DataTransferObjects\FilmDto;
use App\DataTransferObjects\SearchFilmDto;
use App\Models\Film;

interface IFilmRepository
{
    public function getAllFilm();
    public function getFilmById(int $id);
    public function createFilm(array $data);
    public function createFilmDetail(Film $film, array $data);
    public function addFilmGenre(Film $film, array $data);
    public function addImageFilm(Film $film, array $data);
    public function createActorFilm(Film $film, string $name);
    public function createImageFilm(array $data);
    public function updateFilm(array $data, Film $film);
    public function deleteFilm(int $id);
    public function deleteImageFilm(int $id);
    public function FilmPopuler($request);
    public function FilmTerbaru($request);
    public function FilmComingsoon($request);
    public function filmByGenre(FilmDto $dto);
    public function filmBySlug(string $slug);
    public function searchFilm(SearchFilmDto $dto);
}
