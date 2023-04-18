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

    public function createOrder(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $this->success('snap token', $snapToken);
    }


    public function callbackMidtrans(Request $request)
    {
       $serverKey = config('midtrans.server_key');
       $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
         if ($hashed === $request->signature_key) {
             if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
                $transaction = Transaction::where('no_order', $request->order_id)->first();
                $transaction->update([
                    'payment_status' => 'success'
                ]);
             }
         }
    }
}
