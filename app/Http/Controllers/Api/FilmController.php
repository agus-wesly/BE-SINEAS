<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Film\IFilmService;
use App\Services\User\IUserService;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    use ResponseAPI;
    private IFilmService $filmService;
    private IUserService $userService;

    /**
     * @param IFilmService $filmService
     * @param IUserService $userService
     */
    public function __construct(IFilmService $filmService, IUserService $userService)
    {
        $this->filmService = $filmService;
        $this->userService = $userService;
    }


    public function filmPopuler(Request $request): JsonResponse
    {
        return $this->success('list film populer', $this->filmService->getFilmPopuler($request));
    }

    public function filmTerbaru(Request $request): JsonResponse
    {
        return $this->success('list film terbaru', $this->filmService->getFilmTerbaru($request));
    }

    public function filmComingSoon(Request $request): JsonResponse
    {
        return $this->success('list film coming soon', $this->filmService->getFilmComingSoon($request));
    }

    public function listFilmByGenre(Request $request, string $slug): JsonResponse
    {
        return $this->success('list film by genre', $this->filmService->getFilmByGenre($request, $slug));
    }


    public function show(Request $request, string $slug): ?JsonResponse
    {
        try {
            $userId = $this->userService->getUserByToken($request->bearerToken());
            return $this->success('detail film', $this->filmService->getFilmBySlug($slug, $userId));
        } catch (\Exception $e) {
            report($e);
            return $this->error('film not found', 400);
        }
    }

    public function filmRelated(Request $request): ?JsonResponse
    {
        try {
            return $this->success('film related', $this->filmService->getRelatedFilm($request->all()));
        } catch (\Exception $e) {
            report($e);
            return $this->error('film not found', 400);
        }
    }

    public function filmBeingWatched(Request $request): ?JsonResponse
    {
        try {
            return $this->success('list film being Watched', $this->filmService->getFilmBeingWatched($request->all()));
        } catch (\Exception $e) {
            report($e);
            return $this->error($e->getMessage(), 400);
        }
    }

    public function filmWatched(Request $request): ?JsonResponse
    {
        try {
            return $this->success('list film Watched', $this->filmService->getFilmWatched($request->all()));
        } catch (\Exception $e) {
            report($e);
            return $this->error($e->getMessage(), 400);
        }
    }

    public function search(Request $request): JsonResponse
    {
        return $this->success('list film by search', $this->filmService->searchFilm($request));
    }

    public function whislistStore(int $filmId): JsonResponse
    {
        try {
          $whistlist =  $this->filmService->whislistFilm($filmId);
        } catch (\Exception $e) {
            report($e);
            return $this->error('film not found', 400);
        }
        return $this->success('list film by whislist', $whistlist);
    }

    public function whislistList(Request $request): JsonResponse
    {
        return $this->success('list film by whislist', $this->filmService->listWhislistFilm($request->all()));
    }
}
