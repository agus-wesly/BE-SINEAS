<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxasRequest;
use App\Services\Tax\ITaxService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaxController extends Controller
{
    private ITaxService $taxService;

    public function __construct(ITaxService $taxService)
    {
        $this->taxService = $taxService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $taxes = $this->taxService->getAllTaxes();
        return view('pages.Tax.index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.tax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaxasRequest $request): RedirectResponse
    {
        $this->taxService->addTax($request->all());
        return redirect()->route('taxes.index');
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
        $tax = $this->taxService->getTaxById($id);
        return view('pages.tax.edit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaxasRequest $request, string $id): RedirectResponse
    {
        $this->taxService->editTax($request->all(), $id);
        return redirect()->route('taxes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->taxService->deleteTax($id);
        return redirect()->route('taxes.index');
    }
}
