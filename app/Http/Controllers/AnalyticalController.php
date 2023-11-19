<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticalController extends Controller
{

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


    private function getRecentTransactions()
    {
        $recentTransactions = Transaction::orderBy('transNum', 'desc')->take(10)->get();
        $recentData = [];
        foreach ($recentTransactions as $transaction) {
            $recentData[] = $transaction->getDataAsJson();
        }

        return $recentData;
    }

    private function getTransactionDistribution()
    {

        $filters = request()->all();
        $currentDate = Carbon::now();

        $timePeriods = [
            '12 months' => $currentDate->copy()->subYear(),
            '6 months' => $currentDate->copy()->subMonths(6),
            '3 months' => $currentDate->copy()->subMonths(3),
            '1 month' => $currentDate->copy()->subMonth(),
        ];

        $filteredTransactions = [];
        $query = Transaction::query();
        // Apply filters 
        $filteredTransactions = Transaction::where(function ($query) use ($filters, $timePeriods) {
            foreach ($filters as $field => $value) {
                if ($field === 'time_period' && $timePeriods[$value]) {
                    $query->where('transDate', '<=', $timePeriods[$value]);
                }
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



    private function getTransactionTrends()
    {

        // Retrieve filter parameters from the request
        $filters = request()->all();

        $query = Transaction::query();

        // Apply filters 
        foreach ($filters as $field => $value) {
            if ($field === 'itemLocID') {
                // Validate 'itemLocID' against existing values in the 'item_locations' table
                $existsInTable = DB::table('item_location')->where('itemLocID', $value)->exists();

                if (!$existsInTable) {
                    abort(404);
                }
            }
            if (in_array($field, ['itemLocID', 'employeeID'])) {
                $query->where($field, $value);
            }
        }


        $filteredTransactions = $query->get();

        $currentDate = Carbon::now();

        $timePeriods = [
            '12 months' => $currentDate->copy()->subYear(),
            '6 months' => $currentDate->copy()->subMonths(6),
            '3 months' => $currentDate->copy()->subMonths(3),
            '1 month' => $currentDate->copy()->subMonth(),
        ];

        $trend = [];

        // Count transactions for each time period
        foreach ($timePeriods as $period => $startDate) {
            $endDate = next($timePeriods) ?: $currentDate; // If there is no next period, use $currentDate

            $transactionsCount = $filteredTransactions->where('transDate', '>=', $startDate)
                ->where('transDate', '<', $endDate)
                ->count();

            $trend[$period] = $transactionsCount;
        }


        return $trend;
    }
}
