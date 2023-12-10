<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Location;
use App\Models\ItemLocation;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;


/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\InventoryManager
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of inventory items and their locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllItems()
    {
        // Initialize an array to store items grouped by location
        $items = [];

        // Retrieve all locations
        $locations = Location::all();

        // Iterate through each location
        foreach ($locations as $location) {
            // Retrieve items from the current location
            $itemsFromLocation = ItemLocation::where('locID', $location->locID)->get();

            // Group items by location name
            $items[$location->locName] = $itemsFromLocation;
        }

        // Format the items array to include specific item details
        foreach ($items as $locName => $itemCollection) {
            foreach ($itemCollection as $index => $item) {
                $items[$locName][$index] = [
                    'itemName' => $item->getItemName(),
                    'quantity' => $item->getCurrentQty(),
                    'reorder_quantity' => $item->getItemReorderQty(),
                    'vendor' => $item->getVendorName()
                ];
            }
        }

        // Return the formatted items as a JSON response
        return response()->json($items, Response::HTTP_OK);
    }
}
