<?php

namespace App\Services\Tax;

interface ITaxService
{
    public function getAllTaxes(): object;
    public function getTaxRate(): int|float;
    public function getTaxAmountWithRate(int $amount): int|float;
    public function getTaxById(int $id): object;
    public function addTax(array $data): void;
    public function editTax(array $data, int $id): void;
    public function deleteTax(int $id): void;

}
