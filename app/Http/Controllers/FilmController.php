<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests\FilmRequest;
use App\Models\Genre;
use App\Services\Film\IFilmService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmController extends Controller
{
    private IFilmService $filmService;

    /**
     * @param IFilmService $filmService
     */
    public function __construct(IFilmService $filmService)
    {
        $this->filmService = $filmService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = $this->filmService->getAllFilm();


        return view('pages.film.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $genres = Genre::pluck('name', 'id');
        return view('pages.film.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmRequest $request): RedirectResponse
    {
        $request->merge([
            'date' => Carbon::now()->format('Y-m-d'), // 2025-08-17
        ]);
        $this->filmService->addFilm($request);
        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film =$this->filmService->getFilmById($id);
        return view('pages.film.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genres = Genre::pluck('name', 'id');
        $film = $this->filmService->getFilmById($id);
        // dd(compact(['film', 'genres']));
        return view('pages.film.edit', compact(['film', 'genres']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->filmService->updateFilm($request->all(), $id);
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->filmService->deleteFilm($id);
        return redirect()->route('movie.index');
    }
}
