<?php

namespace App\Services\Film;

use App\DataTransferObjects\FilmDto;
use App\DataTransferObjects\PaginateDto;
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
                'error' => $e
            ]);
        }
    }

    public function updateFilm(array $data, int $filmId): mixed
    {
        try {
            $film = $this->filmRepository->getFilmById($filmId);
            \DB::beginTransaction();
            $this->filmRepository->updateFilm($data, $film);
            $this->filmRepository->removeFilmGenre($film);
            $this->filmRepository->addFilmGenre($film, $data['genre_id']);

            if (isset($data['information'])) {
                $this->filmRepository->removeFilmDetail($film);
                $this->filmRepository->createFilmDetail($film, $data['information']);
            }



            if (isset($data['images'])) {
                $this->filmRepository->removeImageFilm($film);
                $this->filmRepository->addImageFilm($film, $data['images']);
            }

            if (isset($data['actor'])) {
                $this->filmRepository->removeActorFilm($film);
                array_map(function ($actor) use ($film) {
                    $this->filmRepository->createActorFilm($film, $actor);
                }, $data['actor']);
            }
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            report($e);
            \DB::rollBack();
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

    public function getFilmBySlug(string $slug, string $userId = null): FilmDetailResource
    {
        try {
            return $this->filmRepository->filmBySlug($slug, $userId);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'Film not found'
            ]);
        }
    }

    public function getRelatedFilm(array $request): object
    {
        try {
            return $this->filmRepository->relatedFilm(
                FilmDto::fromRelatedFilm($request)
            );
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'Film related is empty'
            ]);
        }
    }

    public function getFilmWatched(array $request): object
    {
        try {
            return $this->filmRepository->filmWatched(
                PaginateDto::fromRequest($request)
            );
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getFilmBeingWatched(array $request)
    {
        try {
            return $this->filmRepository->filmBeingWatched(
                PaginateDto::fromRequest($request)
            );
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => $e->getMessage()
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

    public function whislistFilm(int $filmId): mixed
    {
        try {
            $film = $this->filmRepository->getFilmById($filmId);
            return $this->filmRepository->whislistFilm($film);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }

    public function listWhislistFilm($request): mixed
    {
        try {
            return $this->filmRepository->getListWhislistFilm(
                PaginateDto::fromRequest($request)
            );
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'server error'
            ]);
        }
    }


}
