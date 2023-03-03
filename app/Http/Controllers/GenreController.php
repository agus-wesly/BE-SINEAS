<?php

namespace App\Http\Controllers;

use App\Services\genre\IGenreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GenreController extends Controller
{
    private IGenreService $genreService;

    /**
     * @param IGenreService $genreService
     */
    public function __construct(IGenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $genres = $this->genreService->getAllGenres();
        return view('pages.Genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.Genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->genreService->addGenre($request);
        return redirect()->route('genre.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $genre = $this->genreService->getGenreById($id);
        return view('pages.Genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->genreService->editGenre($request, $id);
        return redirect()->route('genre.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->genreService->deleteGenre($id);
        return redirect()->route('genre.index');
    }
}
