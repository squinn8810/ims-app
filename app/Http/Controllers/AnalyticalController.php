<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AnalyticalController extends Controller
{

    /**
     * 
     */
    public function index()
    {
        $recentTransactions = $this->getRecentTransactions();
        $transactionTrends = $this->getTransactionTrends();
        $distributionData = $this->getTransactionDistribution();

        return view('inventory_analytics')->with([
            'recentTransactions' => $recentTransactions,
            'transactionTrends' => $transactionTrends,
            'transactionDistribution' => $distributionData,
        ]);
    }

    /**
     * 
     */
    private function getRecentTransactions()
    {
        $recentTransactions = Transaction::orderBy('transNum', 'desc')->take(10)->get();
        $recentData = [];
        foreach ($recentTransactions as $transaction) {
            $recentData[] = $transaction->getDataAsJson();
        }

        return $recentData;
    }

    /**
     * 
     */
    private function getTransactionDistribution()
    {
        $currentDate = Carbon::now();

        $timePeriods = [
            '12_months' => $currentDate->copy()->subYear(),
            '6_months' => $currentDate->copy()->subMonths(6),
            '3_months' => $currentDate->copy()->subMonths(3),
            '1_month' => $currentDate->copy()->subMonth(),
        ];

        $filter = request()->input('time_period');
    
        $filteredTransactions = [];

        //$query = Transaction::query();

        // Apply filters 
        $filteredTransactions = Transaction::where(function ($query) use ($filter, $timePeriods) {
            if (array_key_exists($filter, $timePeriods)) {
                $query->where('transDate', '<=', $timePeriods[$filter]);
            }
        })
            ->groupBy('itemLocID')
            ->select('itemLocID', DB::raw('count(*) as count'))
            ->get();


        $distributionData = [];
        foreach ($filteredTransactions as $transaction) {
            $item = $transaction->getItemName();
            $count = $transaction['count'];
            $distributionData[$item] = $count;
        }

        return $distributionData;
    }



    /**
     * 
     */
    public function getTransactionTrends()
    {

        // Retrieve filter parameters from the request
        $timePeriods = [
            '12_months' => 12,
            '6_months' => 6,
            '3_months' => 3,
            '1_month' => 1,
        ];
        
        $currentDate = Carbon::now();
        $filter = '12_months';

        // If 'time_period' is present in the request and is a valid key in $timePeriods
        if (request()->has('time_period')) {
            $requestedFilter = request()->input('time_period');

            // Check if the requested filter is a valid key
            if (array_key_exists($requestedFilter, $timePeriods)) {
                $filter = $requestedFilter;
            }
        }

        $validatedData = request()->validate([
            'itemLocID' => 'exists:item_location,itemLocID',
        ]);


        $trend = [];
        $transactions = Transaction::get();

        for ($i = $timePeriods[$filter];$i > 0; $i--) {
            $startDate = $currentDate->copy()->subMonths($i)->startOfMonth();
            $endDate = $currentDate->copy()->subMonths($i-1)->startOfMonth();
        
            // Build and execute the query with conditions
            $transactionsCount = $transactions->when($validatedData, function ($query) use ($validatedData) {
                return $query->where('itemLocID', $validatedData['itemLocID']);
            })
            ->whereBetween('transDate', [$startDate, $endDate->copy()->subSecond()])
            ->count();
        
            $trend[$startDate->format('M y')] = $transactionsCount;
        }

        return $trend;
    }
}
