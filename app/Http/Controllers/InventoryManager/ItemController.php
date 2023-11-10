<?php

namespace App\Http\Controllers\InventoryManager;

use App\Models\Item;
use App\Models\Vendor;
use App\Models\Location;
use Illuminate\View\View;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Providers\RouteServiceProvider;

class ItemController extends Controller
{
    /**
     * Display the form view.
     */
    public function createForm(): View
    {
        $vendors = Vendor::pluck('vendorName', 'vendorID');
        $locations = Location::pluck('locName', 'locID');

        return view('inventory.add_item', compact('locations', 'vendors'));

    }

    /**
     * 
     */
    public function index() {
        return new ItemCollection(Item::all());
    }


    /**
     * Validate input and create/insert item
     */
    public function store(Request $request) {

        $request->validate([
            'itemName' => ['required', 'string', 'max:32'],
            'itemURL' => ['required', 'string', 'max:128'],
            'vendor' => ['required'],
            'location' => ['required'],
            'reorderQty' => ['required', 'string', 'max:32'],
        ]);

        $highestId = Item::max('itemNum');
        $itemNum = $highestId + 1;

        $vendorName = DB::table('vendor')->where('vendorID', $request->vendor)->value('vendorName');

        $item = Item::create([
            'itemNum' => $itemNum,
            'itemName' => $request->itemName,
            'itemURL' => $request->itemURL,
            'vendorName' => $vendorName,
            'vendorID' => $request->vendor,
        ]);

        $item_location = ItemLocation::create([
            'itemNum' => $itemNum, 
            'itemReorderQty' => $request->reorderQty, 
            'locID' => $request->location,
        ]);
        return redirect()->route('inventory.add');
    }
    
    /**
     * 
     */
    public function update(Request $request) {

    }

    /**
     * 
     */
    public function delete(Request $request) {

    }


}
