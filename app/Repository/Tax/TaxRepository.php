<?php

namespace App\Repository\Tax;

use App\Models\Tax;

class TaxRepository implements ITaxRepository
{
    private Tax $tax;
    public function __construct(Tax $tax)
    {
        $this->tax = $tax;
    }

    public function getAllTaxes(): object
    {
        return $this->tax->all();
    }
    public function getTaxRate(): int|float
    {
        return $this->tax->latest()->first()->price;
    }

    public function getTaxAmountWithRate($amount, $rate): int|float
    {
        return $amount * $rate / 100;
    }

    public function getTax(int $id): Tax
    {
        return $this->tax->findOrFail($id);
    }

    public function createTax(array $data): void
    {
        $this->tax->create($data);
    }

    public function updateTax(array $data, Tax $tax): void
    {
        $tax->update($data);
    }
}
