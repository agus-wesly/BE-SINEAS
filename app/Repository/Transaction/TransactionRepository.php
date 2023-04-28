<?php

namespace App\Repository\Transaction;

use App\DataTransferObjects\PaginateDto;
use App\Http\Resources\TransactionSuccessResource;
use App\Models\Transaction;

class TransactionRepository implements ITransactionRepository
{


    public function __construct(
        private readonly Transaction $transaction
    ){}
    public function transactionSuccess(PaginateDto $dto)
    {
        $transactionSuccess = $this->transaction
            ->with('film')
            ->where('user_id',auth()->id())
            ->where('payment_status','success')
            ->paginate($dto->perPage?? 10, page: $dto->page?? 1);

        return [TransactionSuccessResource::collection($transactionSuccess), $transactionSuccess];
    }
}
