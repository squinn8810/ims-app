<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Item;
use App\Models\Vendor;
use App\Models\Location;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Http\Requests\InventoryManager\ItemRequest;

class ItemController extends Controller
{
    /**
     * Display the form view for adding a new item.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function createForm(Request $request)
    {
        // Retrieve vendors and locations for the form dropdowns
        $vendors = Vendor::pluck('vendorName', 'vendorID');
        $locations = Location::pluck('locName', 'locID');

        $data = [
            'vendors' => $vendors,
            'locations' => $locations,
        ];

        // Using the json method on the response
        return response()->json($data);
    }

    /**
     * Display a listing of the items.
     *
     * @return \App\Http\Resources\ItemCollection
     */
    public function index()
    {
        // Return a collection of all items as a JSON resource
        return new ItemCollection(Item::all());
    }

 
    /** Validate input and create/insert a new item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemRequest $request)
    {
        // Create a new item
        $item = Item::create([
            'itemName' => $request->itemName,
            'itemURL' => $request->itemURL,
            'vendorName' => $request->vendorName,
            'vendorID' => $request->vendorID,
        ]);
    
        // Create a corresponding item location entry
        $item_location = ItemLocation::create([
            'itemNum' => $item->itemNum,
            'itemReorderQty' => (int)$request->reorderQty,
            'locID' => $request->location,
        ]);
    
        // Return a JSON response indicating success
        return response()->json(['message' => 'Item created successfully'], 201);
    }
    

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function update(Request $request)
    {
        // Update logic goes here
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function destroy(Request $request)
    {
        // Deletion logic goes here
    }
}
