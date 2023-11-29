<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Item;
use App\Models\Vendor;
use App\Models\Location;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryManager\ItemRequest;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{

    /**
     * Display a listing of the items.
     *
     * @return \App\Http\Resources\ItemCollection
     */
    public function index()
    {
        return ItemResource::collection(Item::paginate(10));
    }

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

        return response()->json($data);
    }




    /** Validate input and create/insert a new item.
     *
     * @param  \Illuminate\Http\Request\InventoryManager\ItemRequest  $request
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
     * @param  \Illuminate\Http\Request\InventoryManager\ItemRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ItemRequest $request, $id)
    {
        // Find the item by its ID
        $item = Item::findOrFail($id);

        // Update the item attributes
        $item->update([
            'itemName' => $request->itemName,
            'itemURL' => $request->itemURL,
            'vendorName' => $request->vendorName,
            'vendorID' => $request->vendorID,
        ]);

        // Update the corresponding item location entry
        $item->location()->update([
            'itemReorderQty' => (int)$request->reorderQty,
        ]);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Item updated successfully'], 200);
    }


    /**
     * Remove the specified item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the item by its ID
        $item = Item::findOrFail($id);

        // Delete the corresponding item location entry
        $item->location()->delete();

        // Delete the item
        $item->delete();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
