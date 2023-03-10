<?php

namespace App\Services\Banner;

use App\Repository\Banner\IBannerRepository;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class BannerService implements IBannerService
{
    use ImageTrait;
    private IBannerRepository $bannerRepo;

    /**
     * @param IBannerRepository $bannerRepo
     */
    public function __construct(IBannerRepository $bannerRepo)
    {
        $this->bannerRepo = $bannerRepo;
    }

    public function getAllBanner(): object
    {
        return $this->bannerRepo->getAll();
    }

    public function getBannerById(int $id): object
    {
        return $this->bannerRepo->getById($id);
    }

    public function addBanner(Request $request): void
    {
        $data = $request->all();
        $data['image'] =  $this->uploadImage('image', $request, 'banner');

        try {
            $this->bannerRepo->create($data);
        } catch (\Exception $e) {
            report($e);
            throw new \Exception($e->getMessage());
        }
    }

    public function editBanner(array $data, $banner): void
    {
        try {
            $this->bannerRepo->update($data, $banner);
        } catch (\Exception $e) {
            report($e);
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteBanner($banner): void
    {
        try {
            $this->bannerRepo->delete($banner);
        } catch (\Exception $e) {
            report($e);
            throw new \Exception($e->getMessage());
        }
    }
}
