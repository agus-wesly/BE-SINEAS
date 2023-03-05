<?php

namespace App\Services\Banner;

interface IBannerService
{
    public function getAllBanner(): object;
    public function getBannerById(int $id): object;
    public function addBanner(array $data): void;
    public function editBanner(array $data, $banner): void;
    public function deleteBanner($banner): void;
}
