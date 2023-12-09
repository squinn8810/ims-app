<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Location;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemLocationResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\LocationResource;

class DashboardController extends Controller
{
    /**
     * Display a listing of inventory items and their locations.
     *
     * @return \App\Http\Resources\ItemCollection
     */
    public function index()
    {

        $items = [];

        $locations = Location::all();

        foreach ($locations as $location) {
            $itemsFromLocation = ItemLocation::where('locID', $location->locID)->get();
            $items[$location->locName] = $itemsFromLocation;
        }

        foreach ($items as $locName => $itemCollection) {
            foreach ($itemCollection as $index => $item) {
                $items[$locName][$index] = [
                    'Item' => $item->getItemName(),
                    'Available Quantity' => $item->itemQty,
                    'Reorder Quantity' => $item->itemReorderQty,
                    'Vendor' => $item->getVendorName(),
                ];
            }
        }

        return response($items, Response::HTTP_OK);
    }
}
