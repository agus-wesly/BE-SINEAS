<?php

namespace App\Services\Film;

use App\Http\Resources\FilmDetailResource;
use App\Models\Film;
use Illuminate\Http\Request;

interface IFilmService
{
    public function getAllFilm(): object;
    public function getFilmById(int $id): Film;
    public function addFilm(Request $request);
    public function updateFilm(array $data, int $filmId): mixed;
    public function deleteFilm(int $id): bool|null;
    public function addImageToFilm(array $data, int $filmId): bool|null;
    public function deleteImageFromFilm(int $filmId): bool|null;
    public function getFilmPopuler(Request $request): object;
    public function getFilmTerbaru(Request $request): object;
    public function getFilmComingSoon(Request $request): mixed;
    public function getFilmByGenre(Request $request, string $slug): object;
    public function getFilmBySlug(string $slug, string $userId): FilmDetailResource;
    public function getRelatedFilm(array $request): object;
    public function getFilmWatched(array $request): object;
    public function getFilmBeingWatched(array $request);
    public function searchFilm(Request $request): object;
    public function whislistFilm(int $filmId): mixed;
    public function listWhislistFilm($request): mixed;
}
