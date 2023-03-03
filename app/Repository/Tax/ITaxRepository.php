<?php

namespace App\Repository\Tax;

use App\Models\Tax;

interface ITaxRepository
{
    public function getAllTaxes(): object;
    public function getTaxRate(): int|float;
    public function getTaxAmountWithRate(int $amount, int $rate): int|float;
    public function getTax(int $id): Tax;
    public function createTax(array $data): void;
    public function updateTax(array $data, Tax $tax): void;
}
