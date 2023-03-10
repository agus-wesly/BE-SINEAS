<?php

namespace App\Repository\FilmSelling;

use App\Models\FilmSelling;

interface IFIlmSellingRepository
{
    public function getAll(): object;
    public function getById(string $id): FilmSelling;
    public function create(array $data): void;
    public function update(array $data, FilmSelling $filmSelling): void;
    public function delete(FilmSelling $filmSelling): void;
}
