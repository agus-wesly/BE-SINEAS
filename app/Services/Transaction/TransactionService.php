<?php

namespace App\Services\Transaction;

use App\DataTransferObjects\PaginateDto;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Validation\ValidationException;

class TransactionService implements ITransactionService
{

    public function __construct(
        private readonly ITransactionRepository $transactionRepository
    ){}

    public function getTransactionSuccess(array $request)
    {
        try {
            $transaction = $this->transactionRepository->transactionSuccess(
                PaginateDto::fromRequest($request)
            );
            return (object) [
                'data' => $transaction[0],
                'links' => [
                    'first' => $transaction[1]->url(1),
                    'last' => $transaction[1]->url($transaction[1]->lastPage()),
                    'prev' => $transaction[1]->previousPageUrl(),
                    'next' => $transaction[1]->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $transaction[1]->currentPage(),
                    'from' => $transaction[1]->firstItem(),
                    'last_page' => $transaction[1]->lastPage(),
                    'path' =>$transaction[1]->path(),
                    'per_page' => $transaction[1]->perPage(),
                    'to' => $transaction[1]->lastItem(),
                    'total' => $transaction[1]->total(),
                ],
            ];
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'Transaction not found'
            ]);
        }
    }
}
