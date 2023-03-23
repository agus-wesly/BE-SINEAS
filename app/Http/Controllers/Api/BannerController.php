<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Banner\IBannerService;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ResponseAPI;

    private IBannerService $bannerService;

    public function __construct(IBannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index(): JsonResponse
    {
        $banners = $this->bannerService->getAllBanner('1');
        return $this->success('list banners', $banners);
    }

    public function show(string $id): JsonResponse
    {
        $banner = $this->bannerService->getBannerById($id);
        return $this->success('detail banner', $banner);
    }
}
