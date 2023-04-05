<?php

namespace App\Services\Film;

use App\DataTransferObjects\FilmDto;
use App\DataTransferObjects\SearchFilmDto;
use App\Enums\TypeFilm;
use App\Http\Resources\FilmDetailResource;
use App\Models\Film;
use App\Repository\Film\IFilmRepository;
use Illuminate\Http\Request;
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
    private function addImage(array $data, Request $request): array
    {
        $data['images']['name'] = [];
        $data['images']['type'] = [];

        if ($request->hasFile('thumbnail')) {
            $data['images']['name'][] = $request->file('thumbnail')->store(
                'assert/film/thumbnail',
                'public'
            );

            $data['images']['type'][] = TypeFilm::Thumbnail->value;
        }

        if ($request->hasFile('background')) {
            $data['images']['name'][] = $request->file('background')->store(
                'assert/film/background',
                'public'
            );
            $data['images']['type'][] = TypeFilm::Background->value;
        }

        return $data;
    }

    public function addFilm(Request $request)
    {
        $data = $request->all();
        $data = $this->addImage($data, $request);
        try {
            \DB::beginTransaction();
            $film = $this->filmRepository->createFilm($data);
            $this->filmRepository->createFilmDetail($film, $data['information']);
            $this->filmRepository->addFilmGenre($film, $data['genre_id']);

            if (isset($data['images'])) {
                $this->filmRepository->addImageFilm($film, $data['images']);
            }

            if (isset($data['actor'])) {
                array_map(function ($actor) use ($film) {
                    $this->filmRepository->createActorFilm($film, $actor);
                }, $data['actor']);
            }
            \DB::commit();
        } catch (\Exception $e) {
            report($e);
            \DB::rollBack();
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

    public function getFilmPopuler(Request $request): object
    {
        try {
            return $this->filmRepository->filmPopuler($request);
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function getFilmTerbaru(Request $request): object
    {
        try {
            return $this->filmRepository->filmTerbaru($request);
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function getFilmComingSoon(Request $request): mixed
    {
        try {
            $film = $this->filmRepository->filmComingSoon($request);
            return (object) [
                'data' => $film[0],
                'links' => [
                    'first' => $film[1]->url(1),
                    'last' => $film[1]->url($film[1]->lastPage()),
                    'prev' => $film[1]->previousPageUrl(),
                    'next' => $film[1]->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $film[1]->currentPage(),
                    'from' => $film[1]->firstItem(),
                    'last_page' => $film[1]->lastPage(),
                    'path' =>$film[1]->path(),
                    'per_page' => $film[1]->perPage(),
                    'to' => $film[1]->lastItem(),
                    'total' => $film[1]->total(),
                ],
            ];
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function getFilmByGenre(Request $request, string $slug): object
    {
        try {
            return $this->filmRepository->filmByGenre(
                FilmDto::fromFilmGenre($request, $slug)
            );
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function getFilmBySlug(string $slug): FilmDetailResource
    {
        try {
            return $this->filmRepository->filmBySlug($slug);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'Film not found'
            ]);
        }
    }

    public function searchFilm(Request $request): object
    {
        try {
            return $this->filmRepository->searchFilm(SearchFilmDto::fromRequest($request));
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }


}
