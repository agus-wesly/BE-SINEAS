<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\Transaction\ITransactionService;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use ResponseAPI;

    public function __construct(
        private readonly ITransactionService $transactionService
    ){}

    public function transactionSuccess(Request $request): JsonResponse
    {
        return $this->success('transaction success', $this->transactionService->getTransactionSuccess($request->all()));
    }

    public function createOrder(Request $request): JsonResponse
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default).
        // Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

       $transaction = Transaction::create($request->all());

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->id,
                'gross_amount' => 20000,
            ),
            'customer_details' => array(
                'first_name' => $transaction->user->name,
                'last_name' => '',
                'email' => $transaction->user->email,
                'phone' => $transaction->user->telp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $this->success('snap token', $snapToken);
    }


    public function callbackMidtrans(Request $request): void
    {
       $serverKey = config('midtrans.server_key');
       $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
       if ($hashed === $request->signature_key) {
         if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
             Transaction::find($request->order_id)->update([
                'payment_status' => 'success',
            ]);
         }

         if ($request->transaction_status == 'cancel' ||
           $request->transaction_status == 'deny' ||
           $request->transaction_status == 'expire'){
           Transaction::find($request->order_id)->update([
               'payment_status' => $request->transaction_status,
           ]);
         }

         if ($request->transaction_status == 'pending'){
           Transaction::find($request->order_id)->update([
               'payment_status' => $request->transaction_status,
           ]);
         }

       }
    }
}
