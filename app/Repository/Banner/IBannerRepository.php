<?php

namespace App\Repository\Banner;

use App\Models\Banner;

interface IBannerRepository
{
    public function getAll(string $status = null): object;
    public function getById(int $id): Banner;
    public function create(array $data): void;
    public function update(array $data, Banner $banner): void;
    public function delete(Banner $banner): void;
}
