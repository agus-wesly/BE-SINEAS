<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Transaction\ITransactionService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use ResponseAPI;

    public function __construct(
        private readonly ITransactionService $transactionService
    ){}

    public function transactionSuccess(Request $request)
    {
        return $this->success('transaction success', $this->transactionService->getTransactionSuccess($request->all()));
    }
}
