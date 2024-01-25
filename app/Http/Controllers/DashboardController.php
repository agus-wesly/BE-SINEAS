<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $startDate = request()->get('startDate');
            $endDate = request()->get('endDate');
            $transactions = $this->getTransactions($startDate, $endDate);

            return response()->json($transactions);
        }

        $filmViews = Film::withCount('filmView')->get();
        $filmsWithActiveSellings = Film::with('filmSelling')
            ->whereHas('filmSelling', function ($query) {
                $query->where('status', 'active');
            })
            ->get();
        $filmsWithComingSoonSellings = Film::with('filmSelling')
            ->whereHas('filmSelling', function ($query) {
                $query->where('status', 'comingsoon');
            })
            ->get();
        $filmsWithExpiredSellings = Film::with('filmSelling')
            ->whereHas('filmSelling', function ($query) {
                $query->where('status', 'expired');
            })
            ->get();
        $filmsWithSellings = [
            'active' => $filmsWithActiveSellings,
            'comingsoon' => $filmsWithComingSoonSellings,
            'expired' => $filmsWithExpiredSellings,
        ];
        $filmsWithNoSellings = Film::with('filmSelling')
        ->whereDoesntHave('filmSelling')
        ->get();
        $transactions = $this->getTransactions(Carbon::today()->subDays(7), Carbon::today());

        return view('dashboard', compact('filmViews', 'filmsWithSellings', 'filmsWithNoSellings', 'transactions'));
    }

    /**
     * Get daily sum of transactions between the provided date.
     */
    public function getTransactions($startDate, $endDate)
    {
        $transactionsWithoutTax = Transaction::select(array(
            DB::raw('DATE(`created_at`) as `date`'),
            DB::raw('SUM(`total`) as `total`')
        ))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('total', 'date');

        $transactionsWithTax = Transaction::select(array(
            DB::raw('DATE(`created_at`) as `date`'),
            DB::raw('SUM(`subtotal`) as `total`')
        ))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('total', 'date');

        $taxes = Transaction::select(array(
            DB::raw('DATE(`created_at`) as `date`'),
            DB::raw('SUM(`tax`) as `taxes`')
        ))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('taxes', 'date');

        return [
            'transactionsWithoutTax' => $transactionsWithoutTax,
            'transactionsWithTax' => $transactionsWithTax,
            'taxes' => $taxes
        ];
    }
}
