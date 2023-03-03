<?php

namespace App\Services\Tax;

use App\Repository\Tax\ITaxRepository;
use Illuminate\Validation\ValidationException;

class TaxService implements ITaxService
{
    private ITaxRepository $taxRepo;

    public function __construct(ITaxRepository $taxRepo)
    {
        $this->taxRepo = $taxRepo;
    }

    public function getAllTaxes(): object
    {
        try {
            return $this->taxRepo->getAllTaxes();
        } catch (\Exception $e) {
            report($e);
            return (object)[];
        }
    }
    public function getTaxRate(): int|float
    {
        try {
           return $this->taxRepo->getTaxRate();
        } catch (\Exception $e) {
            report($e);
            return 0;
        }
    }

    public function getTaxAmountWithRate(int $amount): int|float
    {
           try {
                $rate = $this->getTaxRate();
                return $this->taxRepo->getTaxAmountWithRate($amount, $rate);
            } catch (\Exception $e) {
               report($e);
                return 0;
            }
    }

    public function getTaxById(int $id): object
    {
        try {
            return $this->taxRepo->getTax($id);
        } catch (\Exception $e) {
            report($e);
            return (object)[];
        }
    }

    public function addTax(array $data): void
    {
//        try {
            $this->taxRepo->createTax($data);
//        } catch (\Exception $e)
//        {
//            report($e);
//            throw ValidationException::withMessages(['error' => 'Something went wrong']);
//        }
    }

    public function editTax(array $data, int $id): void
    {
        try {
            $tax = $this->taxRepo->getTax($id);
            $this->taxRepo->updateTax($data, $tax);
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages(['error' => 'Something went wrong']);
        }
    }

    public function deleteTax(int $id): void
    {
        try {
            $this->taxRepo->getTax($id)->delete();
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages(['error' => 'Something went wrong']);
        }
    }
}
