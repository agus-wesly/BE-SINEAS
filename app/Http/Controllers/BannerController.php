<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Services\Banner\IBannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BannerController extends Controller
{
    private IBannerService $bannerService;

    /**
     * @param IBannerService $bannerService
     */
    public function __construct(IBannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $banners = $this->bannerService->getAllBanner();
        return view('pages.Banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.Banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->bannerService->addBanner($request->all());
        return redirect()->route('banners.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Banner $banner): View
    {
        return view('pages.Banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner): View
    {
        return view('pages.Banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner): RedirectResponse
    {
        $this->bannerService->editBanner($request->all(), $banner);
        return redirect()->route('banners.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner): RedirectResponse
    {
        $this->bannerService->deleteBanner($banner);
        return redirect()->route('banners.index');
    }
}
