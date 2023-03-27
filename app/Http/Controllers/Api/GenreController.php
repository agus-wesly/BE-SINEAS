<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\genre\IGenreService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    use ResponseAPI;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, IGenreService $genreService)
    {
        return $this->success('list genre', $genreService->getAllGenres());
    }
}
