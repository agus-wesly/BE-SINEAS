<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmSellingPriceRequest;
use App\Services\FilmSellingPrice\FilmSellingPriceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FilmSellingPriceController extends Controller
{
    private FilmSellingPriceService $filmSellingPriceService;

    /**
     * @param FilmSellingPriceService $filmSellingPriceService
     */
    public function __construct(FilmSellingPriceService $filmSellingPriceService)
    {
        $this->filmSellingPriceService = $filmSellingPriceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $filmSellingPrices = $this->filmSellingPriceService->getAllFilmSellingPrice();
        return view('pages.Film_selling_price.index', compact('filmSellingPrices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.Film_selling_price.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmSellingPriceRequest $request): RedirectResponse
    {
        $this->filmSellingPriceService->addFilmSellingPrice($request->all());
        return redirect()->route('film-selling-price.index');
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
        $filmSellingPrice = $this->filmSellingPriceService->getFilmSellingPriceById($id);
        return view('pages.Film_selling_price.edit', compact('filmSellingPrice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmSellingPriceRequest $request, string $id): RedirectResponse
    {
        $this->filmSellingPriceService->editFilmSellingPrice($request->all(), $id);
        return redirect()->route('film-selling-price.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->filmSellingPriceService->deleteFilmSellingPrice($id);
        return redirect()->route('film-selling-price.index');
    }
}
