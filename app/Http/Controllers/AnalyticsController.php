<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\ItemLocation;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{

    /**
     * Returns a descriptive data view
     */
    public function dataView1()
    {
        $recentTransactions = $this->getRecentTransactions();
        $transactionTrends = $this->getTransactionTrends();
        $distributionData = $this->getTransactionDistribution();

        $data = [
            'recentTransactions' => $recentTransactions,
            'transactionTrends' => $transactionTrends,
            'transactionDistribution' => $distributionData,
        ];

        /*return view('inventory_descriptive')->with([
            'recentTransactions' => $recentTransactions,
            'transactionTrends' => $transactionTrends,
            'transactionDistribution' => $distributionData,
        ]);*/

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * 
     */
    private function getRecentTransactions()
    {
        $recentTransactions = Transaction::orderBy('transDate', 'desc')->take(10)->get();
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
                $query->where('transDate', '>=', $timePeriods[$filter]);
            }
        })
            ->where('itemQty', '<', 0)
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

        for ($i = $timePeriods[$filter]; $i >= 0; $i--) {
            $startDate = $currentDate->copy()->subMonths($i)->startOfMonth();

            // Check if it's the current month
            if ($i === 0) {
                $endDate = $currentDate->copy()->endOfMonth();
            } else {
                $endDate = $currentDate->copy()->subMonths($i - 1)->startOfMonth()->endOfMonth();
            }

            $transactionsCount = Transaction::when($validatedData, function ($query) use ($validatedData) {
                return $query->where('itemLocID', $validatedData['itemLocID']);
            })
                ->whereBetween('transDate', [$startDate, $endDate])
                ->where('itemQty', '<', 0)
                ->count();

            $trend[$startDate->format('M Y')] = $transactionsCount;
        }

        return $trend;
    }

    /******************************************************************************************************* */

    /**
     * Returns a prescriptive/predictive data view
     */
    public function dataView2()
    {

        if (request()->has('itemLocID')) {

            $transactionData = $this->getTransactionData();
            $lowSupplyTrends = $transactionData["lowSupply"];
            $restockSupplyTrends = $transactionData["restock"];

            $inventoryData = $this->inventoryTraffic();

            $inventoryTrafficData = $inventoryData["inventoryData"];
            $avgInvLvl = $inventoryData["avgInvLevel"];


            $evalData = $this->evaluateReorderQty($lowSupplyTrends);
            $filterItems = $this->getPopularItems();

            $data = [
                "filterItems" => $filterItems,
                "lowSupplyData" => $lowSupplyTrends,
                "restockData" => $restockSupplyTrends,
                "evalData" => $evalData,
                "trafficFlow" => $inventoryTrafficData,
                "sumTrafficFlow" => $avgInvLvl,
            ];

            return response()->json($data, Response::HTTP_OK);
        } else {

            $transactionData = $this->getTransactionData();
            $lowSupplyTrends = $transactionData["lowSupply"];
            $restockSupplyTrends = $transactionData["restock"];

            $filterItems = $this->getPopularItems();

            $data = [
                "filterItems" => $filterItems,
                "lowSupplyData" => $lowSupplyTrends,
                "restockData" => $restockSupplyTrends,
            ];

            return response()->json($data, Response::HTTP_OK);
        }
    }

    /**
     * 
     */
    public function getTransactionData()
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


        $lowSupplyTransactions = [];
        $restockTransactions = [];

        for ($i = $timePeriods[$filter]; $i >= 0; $i--) {
            $startDate = $currentDate->copy()->subMonths($i)->startOfMonth();

            // Check if it's the current month
            if ($i === 0) {
                $endDate = $currentDate->copy()->endOfMonth();
            } else {
                $endDate = $currentDate->copy()->subMonths($i - 1)->startOfMonth();
            }

            $lowSupplyTransactions = Transaction::when($validatedData, function ($query) use ($validatedData) {
                return $query->where('itemLocID', $validatedData['itemLocID']);
            })
                ->whereBetween('transDate', [$startDate, $endDate])
                ->where('itemQty', '<', 0)
                ->count();


            $restockTransactions = Transaction::when($validatedData, function ($query) use ($validatedData) {
                return $query->where('itemLocID', $validatedData['itemLocID']);
            })
                ->whereBetween('transDate', [$startDate, $endDate])
                ->where('itemQty', '>', 0)
                ->count();


            $lowSupplyTrend[$startDate->format('M Y')] = $lowSupplyTransactions;
            $restockSupplyTrend[$startDate->format('M Y')] = $restockTransactions;
        }

        return ["lowSupply" => $lowSupplyTrend, "restock" => $restockSupplyTrend];
    }



    private function getPopularItems()
    {
        //returns an array of arrays with key value pairs
        $groupTransactions = DB::table('transaction')
            ->select('itemLocID', DB::raw('COUNT(*) as count'))
            ->groupBy('itemLocID')
            ->orderByDesc('count')
            ->get();

        $filterItems = [];

        foreach ($groupTransactions as $group) {
            $itemLocID = $group->itemLocID;
            //$count = $group->count;
            $itemLoc = ItemLocation::find($itemLocID);
            $item = Item::find($itemLoc->itemNum);
            $itemName = $item->itemName;

            $filterItems[] = [
                'itemName' => $itemName,
                'itemLocID' => $itemLocID,
            ];
        }

        return $filterItems;
    }



    /**
     * Endpoint to provide reorder counts
     */
    private function evaluateReorderQty(array $transactionData)
    {

        if (Request()->has('itemLocID')) {

            $numMonths = 0;
            $sumCounts = 0;

            foreach ($transactionData as $count) {
                $numMonths++;
                $sumCounts += $count;
            }

            $factor = 1;

            if ($sumCounts > $numMonths) {
                $factor = ($sumCounts / $numMonths);
            }

            $itemLocRecord = ItemLocation::find(Request('itemLocID'));

            $reorderQty = $itemLocRecord->itemReorderQty;

            $suggestedQty = $reorderQty * $factor;

            return $evalData = [
                $reorderQty,
                $suggestedQty,
            ];
        }
        return $evalData = [
            0,
            0,
        ];
    }

    private function inventoryTraffic()
    {

        $request = Request();
        // Retrieve filter parameters from the request
        $timePeriods = [
            '12_months' => 12,
            '6_months' => 6,
            '3_months' => 3,
            '1_month' => 1,
        ];

        $currentDate = Carbon::now();
        $requestedFilter = '12_months';

        // If 'time_period' is present in the request and is a valid key in $timePeriods
        if (request()->has('time_period')) {
            $requestedFilter = request()->input('time_period');
        }

        $startDate = $currentDate->copy()->subMonths($timePeriods[$requestedFilter])->startOfMonth();

        $transactions = Transaction::where('itemLocID', request()->itemLocID)
            ->where('transDate', '>=', $startDate)
            ->orderBy('transDate', 'asc')
            ->get();

        $inventoryTrafficData = [];

        $avgInvLvl = 0;

        foreach ($transactions as $transaction) {
            $inventoryTrafficData[$transaction->transDate] = $transaction->itemQty;
            $nextQty = $transaction->itemQty;
            $avgInvLvl += $nextQty;
        }



        return ["inventoryData" => $inventoryTrafficData, "avgInvLevel" => $avgInvLvl];
    }
}
