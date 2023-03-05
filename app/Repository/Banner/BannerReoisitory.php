<?php

namespace App\Repository\Banner;

use App\Models\Banner;

class BannerReoisitory implements IBannerRepository
{
    private Banner $banner;

    /**
     * @param Banner $banner
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }


    public function getAll(): object
    {
        return $this->banner
                    ->toBase()
                    ->get();
    }

    public function getById(int $id): Banner
    {
        return $this->banner->findOrfail($id);
    }

    public function create(array $data): void
    {
        $this->banner->create($data);
    }

    public function update(array $data, Banner $banner): void
    {
       $banner->update($data);
    }

    public function delete(Banner $banner): void
    {
        $banner->delete();
    }
}
