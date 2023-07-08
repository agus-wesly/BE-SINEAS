<?php

namespace App\Repository\Banner;

use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Carbon\Carbon;

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
        $currentDate = Carbon::now();
    
        if ($status) {
            return BannerResource::collection(
                $this->banner->where('status', $status)
                    ->whereDate('expired_date', '>', $currentDate)
                    ->orderBy('created_at', 'desc')
                    ->toBase()
                    ->get()
            );
        }
        
        return BannerResource::collection(
            $this->banner
                ->orderBy('created_at', 'desc')
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
