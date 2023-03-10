<?php

namespace App\Services\FilmSellingPrice;

interface IFilmSellingPriceService
{
    public function getAllFilmSellingPrice(): object;
    public function getFilmSellingPriceById(string $id): object;
    public function addFilmSellingPrice(array $data): void;
    public function editFilmSellingPrice(array $data, string $id): void;
    public function deleteFilmSellingPrice(string $id): void;
}
