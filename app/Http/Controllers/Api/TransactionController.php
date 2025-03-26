<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Faker;
use App\Models\Transaction;
use App\Services\Film\IFilmService;
use App\Services\Tax\ITaxService;
use App\Services\Transaction\ITransactionService;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\FilmSellingPrice;
use App\Models\FilmSelling;
use App\Models\FilmView;

class TransactionController extends Controller
{
    use ResponseAPI;

    public function __construct(
        private readonly ITransactionService $transactionService,
        private readonly IFilmService $filmService,
        private readonly ITaxService $taxService
    ) {}

    public function transactionSuccess(Request $request): JsonResponse
    {
        return $this->success('transaction success', $this->transactionService->getTransactionSuccess($request->all()));
    }

    public function createOrder(Request $request): JsonResponse
    {
        // return $this->success('snap token', "foo");
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = "SB-Mid-server-FPqTzES1lNlP2HNc4K_r1Dax";
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $data = $request->all();
        $film = $this->filmService->getFilmBySlug($data['film_id']);
        $film = json_encode($film);
        $film = json_decode($film);

        //SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`sineasmov`.`transactions`, CONSTRAINT `transactions_film_selling_id_foreign` FOREIGN KEY (`film_selling_id`) REFERENCES `film_sellings` (`id`)) (Connection: mysql, SQL: insert into `transactions` (`film_id`, `user_id`, `film_selling_id`, `tax`, `title_film`, `total`, `subtotal`, `code`, `payment_date`, `id`, `updated_at`, `created_at`) values (447362, ok2vzv4pr00s48o0, 1, 0, Life in a Year, 6969, 6969, 6969, 2025-03-25 22:55:19, 3lnvazcalygw4o00, 2025-03-25 22:55:19, 2025-03-25 22:55:19)).


        $data['user_id'] = auth()->user()->id;
        $data['code'] = Faker\Factory::create()->uuid();
        $data['film_id'] = $film->id;
        $data['film_selling_id'] = $film->film_selling_id;
        $data['tax'] = 0;
        $data['title_film'] = $film->title;
        $data['total'] = $film->price;
        $data['subtotal'] = $film->price + $this->taxService->getTaxRate();
        $data['payment_date'] = Carbon::now();
        $data['payment_status'] = "success";


        try {
            $transaction = Transaction::create($data);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return $this->success('snap token', "foo");
        }


        // todo : this is causing error, figure out why



        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->id,
                'gross_amount' => $data['subtotal'],
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
        error_log("MIDTRANS CALLBACK");
        try {
            $serverKey = config('midtrans.server_key');
            $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            $film = Transaction::where('id', $request->order_id)->first();
            //search data duration sewa film
            $idFilmSelling = $film->film_selling_id;
            //find filmSelling by id
            $filmSelling = FilmSelling::where('id', $idFilmSelling)->first();
            $filmSellingPriceId = $filmSelling->film_selling_price_id;
            //find filmSellingPrice by id filmSelling
            $getDataDuration = FilmSellingPrice::where('id', $filmSellingPriceId)->first();

            if ($hashed === $request->signature_key) {
                if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {

                    Transaction::find($request->order_id)->update([
                        'payment_status' => 'success',
                        'payment_method' => $request->payment_type,
                        'watch_expired_date' => Carbon::now()->addDays($getDataDuration->duration),
                        'transaction_date' => Carbon::now(),
                    ]);

                    //create film view
                    FilmView::Create([
                        'user_id' => $film->user_id,
                        'film_id' => $film->film_id,
                        'transaction_id' => $film->id,
                    ]);
                }



                if (
                    $request->transaction_status == 'cancel' ||
                    $request->transaction_status == 'deny' ||
                    $request->transaction_status == 'expire'
                ) {
                    Transaction::find($request->order_id)->update([
                        'payment_status' => $request->transaction_status,
                        'payment_method' => $request->payment_type,
                    ]);
                }

                if ($request->transaction_status == 'pending') {
                    Transaction::find($request->order_id)->update([
                        'payment_status' => $request->transaction_status,
                        'payment_method' => $request->payment_type,
                    ]);
                }
            }

            response()->json([
                'status' => 'success',
                'message' => 'callback success',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
