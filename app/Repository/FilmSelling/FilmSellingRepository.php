<?php

namespace App\Repository\FilmSelling;
use App\Models\FilmSelling;

class FilmSellingRepository implements IFIlmSellingRepository
{
    private FilmSelling $filmSelling;

    /**
     * @param FilmSelling $filmSelling
     */
    public function __construct(FilmSelling $filmSelling)
    {
        $this->filmSelling = $filmSelling;
    }


    public function getAll(): object
    {
        return $this->filmSelling->with(['film', 'sellingPrice'])->get();
    }

    public function getById(string $id): FilmSelling
    {
        return $this->filmSelling->findOrFail($id);
    }

    public function create(array $data): void
    {
        $this->filmSelling->create($data);
    }

    public function update(array $data, FilmSelling $filmSelling): void
    {
        $filmSelling->update($data);
    }

    public function delete(FilmSelling $filmSelling): void
    {
        $filmSelling->delete();
    }
}
