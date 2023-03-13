<?php

namespace App\Repository\FilmSellingPrice;


use App\Models\FilmSellingPrice;

interface IFilmSellingPriceRepository
{
    public function getAll(): object;
    public function getById(string $id): FilmSellingPrice;
    public function create(array $data): void;
    public function update(array $data, FilmSellingPrice $filmSellingPrice): void;
    public function delete(FilmSellingPrice $filmSellingPrice): void;
}
