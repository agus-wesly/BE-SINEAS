<?php

namespace App\Services\FilmSellingPrice;

use App\Models\FilmSelling;
use App\Repository\FilmSellingPrice\IFilmSellingPriceRepository;
use Illuminate\Validation\ValidationException;

class FilmSellingPriceService implements IFilmSellingPriceService
{
    private IFilmSellingPriceRepository $filmSellingPriceRepo;

    /**
     * @param IFilmSellingPriceRepository $filmSellingPriceRepository
     */
    public function __construct(IFilmSellingPriceRepository $filmSellingPriceRepository)
    {
        $this->filmSellingPriceRepo = $filmSellingPriceRepository;
    }

    public function getAllFilmSellingPrice(): object
    {
        return $this->filmSellingPriceRepo->getAll();
    }

    public function getFilmSellingPriceById(string $id): object
    {
        try {
            return $this->filmSellingPriceRepo->getById($id);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages(['message' => 'Film Selling Price not found']);
        }
    }

    public function addFilmSellingPrice(array $data): void
    {
        try {
            $this->filmSellingPriceRepo->create($data);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages(['message' => 'Film Selling Price not created']);
        }
    }

    public function editFilmSellingPrice(array $data, string $id): void
    {
        try {
            $filmSellingPrice = $this->filmSellingPriceRepo->getById($id);
            // need to get the film selling from here
            $filmSelling = FilmSelling::findOrFail($data['id']);
            $filmSelling->update(['is_free' => $data['is_free']]);
            $this->filmSellingPriceRepo->update($data, $filmSellingPrice);

        } catch (\Exception $e) {
            report($e);
            $exception = $e->getMessage();
            error_log($exception);
            throw ValidationException::withMessages(['message' => 'Film Selling Price not updated']);
        }
    }

    public function deleteFilmSellingPrice(string $id): void
    {
        try {
            $filmSellingPrice = $this->filmSellingPriceRepo->getById($id);
            $this->filmSellingPriceRepo->delete($filmSellingPrice);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages(['message' => 'Film Selling Price not deleted']);
        }
    }
}
