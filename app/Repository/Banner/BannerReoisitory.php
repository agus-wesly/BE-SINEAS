<?php

namespace App\Repository\Banner;

use App\Http\Resources\BannerResource;
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


    public function getAll(string $status = null): object
    {
        if ($status) {
            return BannerResource::collection(
                $this->banner->where('status', $status)
                    ->orderByDesc('expired_date')
                    ->toBase()
                    ->get()
            );
        }
        return BannerResource::collection(
            $this->banner
                ->orderByDesc('expired_date')
                ->toBase()
                ->get()
        );
    }

    public function getById(int $id): Banner
    {
        return $this->banner->findOrFail($id);
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
