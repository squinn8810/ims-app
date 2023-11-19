<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsightsController extends Controller
{
    //not all items need to be ordered monthly
    //only items ordered more frequently than one month should be adjusted

    public function index()
    {

        $reorderQtyData = $this->getCumulativeReorderCounts();
        $frequentItems = $this->getFrequentlyOrderedItems();

        return view('inventory_insights')->with([
            "reorderQtyData" => $reorderQtyData,
            "frequentItems" => $frequentItems,
        ]);
    }


    private function getFrequentlyOrderedItems()
    {
        //returns an array of arrays with key value pairs
        $groupTransactions = DB::table('transaction')
            ->select('itemLocID', DB::raw('COUNT(*) as count'))
            ->groupBy('itemLocID')
            ->orderByDesc('count')
            ->get();

        $frequentItemData = [];

        foreach ($groupTransactions as $group) {
            $itemLocID = $group->itemLocID;
            $count = $group->count;
            $itemLoc = ItemLocation::find($itemLocID);
            $item = Item::find($itemLoc->itemNum);
            $itemName = $item->itemName;

            $frequentItemData[] = 
            [
                'Item' => $itemName,
                'Transactions' => $count,
                'itemLocID' => $itemLocID,
            ];
        }

        return $frequentItemData;
    }


    /**
     * Calculate the reorder count for a specific date range
     */
    private function calculateReorderCount($itemLocID, $startDate)
    {
        $reorderCount = Transaction::where('itemLocID', $itemLocID)
            ->where('transDate', '>=', $startDate)
            ->count();

        return $reorderCount;
    }

    /**
     * Endpoint to provide reorder counts
     */
    private function getCumulativeReorderCounts()
    {
        if (Request()->input('itemLocID')) {
            $itemLocID = Request()->input('itemLocID');

            // Calculate the date ranges for 1 month, 3 months, 6 months, and 12 months
            $dateRanges = [
                '1 month' => now()->subMonth(),
                '3 months' => now()->subMonths(3),
                '6 months' => now()->subMonths(6),
                '1 year' => now()->subYear(),
                '2 years' => now()->subYears(2),
            ];

            $reorderQtyData = [];

            // Calculate reorder counts for each date range
            foreach ($dateRanges as $range => $startDate) {
                $count = $this->calculateReorderCount($itemLocID, $startDate);

                $reorderQty = (int)ItemLocation::where('itemLocID', $itemLocID)
                ->value('itemReorderQty');

                if ($range == '1 month' && $count > 0) {
                    $percent = 1 / $count;
                    $reorderQty = $reorderQty * $percent;
                }
                if ($range == '3 months' && $count > 0) {
                    $percent = 3 / $count;
                    $reorderQty = $reorderQty * $percent;
                }
                if ($range == '6 months' && $count > 0) {
                    $percent = 6 / $count;
                    $reorderQty = $reorderQty * $percent;
                }
                if ($range == '1 year' && $count > 0) {
                    $percent = 12 / $count;
                    $reorderQty = $reorderQty * $percent;
                }
                if ($range == '2 year' && $count > 0) {
                    $percent = 24 / $count;
                    $reorderQty = $reorderQty * $percent;
                }

                $reorderQtyData[$range] = [$count, $reorderQty];
            }

            return $reorderQtyData;
        }
    }
}
