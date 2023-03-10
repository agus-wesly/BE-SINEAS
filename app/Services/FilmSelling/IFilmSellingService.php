<?php

namespace App\Services\FilmSelling;

use App\Models\FilmSelling;

interface IFilmSellingService
{
    public function getAllFilmSelling(): object;
    public function getFilmSellingById(string $id): FilmSelling;
    public function addFilmSelling(array $data): void;
    public function editFilmSelling(array $data, string $id): void;
    public function deleteFilmSelling(string $id): void;
}
