<?php

namespace App\Http\Controllers;

use App\Services\Film\IFilmService;
use App\Services\FilmSelling\IFilmSellingService;
use App\Services\FilmSellingPrice\IFilmSellingPriceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmSellingController extends Controller
{
    private IFilmSellingService $filmSellingService;
    private IFilmService $filmService;
    private IFilmSellingPriceService $filmSellingPriceService;

    /**
     * @param IFilmSellingService $filmSellingService
     * @param IFilmService $filmService
     * @param IFilmSellingPriceService $filmSellingPriceService
     */
    public function __construct(IFilmSellingService $filmSellingService, IFilmService $filmService, IFilmSellingPriceService $filmSellingPriceService)
    {
        $this->filmSellingService = $filmSellingService;
        $this->filmService = $filmService;
        $this->filmSellingPriceService = $filmSellingPriceService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $filmSellings = $this->filmSellingService->getAllFilmSelling();
        return view('pages.film_selling.index', compact('filmSellings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $films = $this->filmService->getAllFilm();
        $filmSellingPrices = $this->filmSellingPriceService->getAllFilmSellingPrice();
        return view('pages.film_selling.create', compact(['films', 'filmSellingPrices']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->filmSellingService->addFilmSelling($request->all());
        return redirect()->route('film-selling.index');
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
        $filmSelling = $this->filmSellingService->getFilmSellingById($id);
        return view('pages.film_selling.edit', compact('filmSelling'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->filmSellingService->editFilmSelling($request->all(), $id);
        return redirect()->route('film-selling.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->filmSellingService->deleteFilmSelling($id);
        return redirect()->route('film-selling.index');
    }
}
