<?php

namespace App\Repository\Transaction;

use App\DataTransferObjects\PaginateDto;

interface ITransactionRepository
{
    public function transactionSuccess(PaginateDto $dto);
}
