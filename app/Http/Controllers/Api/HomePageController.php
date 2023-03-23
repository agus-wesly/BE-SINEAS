<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Film\IFilmService;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    use ResponseAPI;
    private IFilmService $filmService;

    /**
     * @param IFilmService $filmService
     */
    public function __construct(IFilmService $filmService)
    {
        $this->filmService = $filmService;
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
}
