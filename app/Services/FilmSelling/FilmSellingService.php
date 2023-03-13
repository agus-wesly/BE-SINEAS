<?php

namespace App\Services\FilmSelling;

use App\Models\FilmSelling;
use App\Repository\FilmSelling\IFIlmSellingRepository;
use Illuminate\Validation\ValidationException;

class FilmSellingService implements IFilmSellingService
{
    private IFIlmSellingRepository $sellingRepo;

    /**
     * @param IFIlmSellingRepository $sellingRepo
     */
    public function __construct(IFIlmSellingRepository $sellingRepo)
    {
        $this->sellingRepo = $sellingRepo;
    }

    public function getAllFilmSelling(): object
    {
        return $this->sellingRepo->getAll();
    }

    public function getFilmSellingById(string $id): FilmSelling
    {
        try {
            return $this->sellingRepo->getById($id);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages(['message' => 'Film Selling not found']);
        }
    }

    public function addFilmSelling(array $data): void
    {
        try {
            $this->sellingRepo->create($data);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages(['message' => 'Film Selling not created']);
        }
    }

    public function editFilmSelling(array $data, string $id): void
    {
        try {
            $filmSelling = $this->sellingRepo->getById($id);
            $this->sellingRepo->update($data, $filmSelling);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages(['message' => 'Film Selling not updated']);
        }
    }

    public function deleteFilmSelling(string $id): void
    {
        try {
            $filmSelling = $this->sellingRepo->getById($id);
            $this->sellingRepo->delete($filmSelling);
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages(['message' => 'Film Selling not deleted']);
        }
    }
}
