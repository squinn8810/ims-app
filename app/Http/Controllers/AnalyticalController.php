<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionCollection;

class AnalyticalController extends Controller
{

    public function index()
    {
        $recentTransactions = $this->getRecentTransactions();
        $transactionTrends = $this->getTransactionTrends();

        return view('data_dashboard')->with([
            'recentTransactions' => $recentTransactions,
            'transactionTrends' => $transactionTrends,
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




    private function getTransactionTrends()
    {

        // Retrieve filter parameters from the request
        $filters = request()->all();

        // Start with a base query for the Transaction model
        $query = Transaction::query();

        // Apply filters dynamically
        foreach ($filters as $field => $value) {
            if (in_array($field, ['itemLocID', 'employeeID'])) {
                $query->where($field, $value);
            }
        }

        // Continue with the rest of your query logic (e.g., ordering)
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
            // Calculate the end date for the current time period (next start date)
            $endDate = next($timePeriods) ?: $currentDate; // If there is no next period, use $currentDate

            $transactionsCount = $filteredTransactions->where('transDate', '>=', $startDate)
                ->where('transDate', '<', $endDate) // Adjusted to use '<' to include transactions up to, but not including, the end date
                ->count();

            // Store the count in the trend array
            $trend[$period] = $transactionsCount;
        }


        return $trend;
    }
}
