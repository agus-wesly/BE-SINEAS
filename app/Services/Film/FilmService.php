<?php

namespace App\Services\Film;

use App\Models\Film;
use App\Repository\Film\IFilmRepository;
use Illuminate\Validation\ValidationException;

class FilmService implements IFilmService
{
    private IFilmRepository $filmRepository;

    public function __construct(IFilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function getAllFilm(): object
    {
        return $this->filmRepository->getAllFilm();
    }

    public function getFilmById(int $id): Film
    {
        try {
            return $this->filmRepository->getFilmById($id);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'Film not found'
            ]);
        }
    }

    public function addFilm(array $data): bool|null
    {
        try {
            return $this->filmRepository->createFilm($data);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function updateFilm(array $data, int $filmId): bool|null
    {
        try {
            $film = $this->filmRepository->getFilmById($filmId);
            return $this->filmRepository->updateFilm($data, $film);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function deleteFilm(int $id): bool|null
    {
        try {
            return $this->filmRepository->deleteFilm($id);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function addImageToFilm(array $data, int $filmId): bool|null
    {
        try {
            $film = $this->filmRepository->getFilmById($filmId);
            return $this->filmRepository->createImageFilm($data, $film);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function deleteImageFromFilm(int $filmId): bool|null
    {
        try {
            $film = $this->filmRepository->getFilmById($filmId);
            return $this->filmRepository->deleteImageFilm($film);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }
}
