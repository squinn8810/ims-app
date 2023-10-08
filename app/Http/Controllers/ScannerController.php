<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Location;
use App\Mail\ReorderMail;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ScannerController extends Controller
{

    public function analyze(Request $request)
    {

        try {
            // Get the JSON data from the request body
            $requestData = json_decode($request->getContent(), true);

            $results = $requestData['scanData'];

            //Extract the item name and location name from DB
            $itemLocID = $results[1];
            $itemLoc = ItemLocation::find($itemLocID);
            $locId = $itemLoc->locID;
            $location = Location::find($locId);
            $locName = $location->locName;
            $itemNum = $itemLoc->itemNum;
            $item = Item::find($itemNum);
            $itemName = $item->itemName;

            Session::put('locations', $locName);
            Session::put('items', $itemName);
            Session::put('scanSuccess', true);

            return redirect()->route('scan');
        } catch (\Exception $e) {

            // Handle any exceptions that may occur
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
