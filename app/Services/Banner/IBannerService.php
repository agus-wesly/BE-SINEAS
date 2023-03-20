<?php

namespace App\Services\Banner;

use Illuminate\Http\Request;

interface IBannerService
{
    public function getAllBanner(string $status = null): object;
    public function getBannerById(int $id): object;
    public function addBanner(Request $data): void;
    public function editBanner(array $data, $banner): void;
    public function deleteBanner($banner): void;
}
