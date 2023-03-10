<?php

namespace App\Repository\FilmSellingPrice;

use App\Models\FilmSellingPrice;

class FilmSellingPriceRepository implements IFilmSellingPriceRepository
{
    private FilmSellingPrice $model;

    /**
     * @param FilmSellingPrice $filmSellingPrice
     */
    public function __construct(FilmSellingPrice $filmSellingPrice)
    {
        $this->model = $filmSellingPrice;
    }

    public function getAll(): object
    {
        return $this->model->all();
    }

    public function getById(string $id): FilmSellingPrice
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): void
    {
       $this->model->create($data);
    }

    public function update(array $data, FilmSellingPrice $filmSellingPrice): void
    {
        $filmSellingPrice->update($data);
    }

    public function delete(FilmSellingPrice $filmSellingPrice): void
    {
        $filmSellingPrice->delete();
    }
}
