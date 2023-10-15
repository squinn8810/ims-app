<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Item;
use App\Models\Location;
use App\Mail\ReorderMail;
use App\Models\Transaction;
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
            //Generate transaction
            $easternTimeZone = new DateTimeZone('America/New_York');
            $transaction = Transaction::create([
                'transDate' => new DateTime('now', $easternTimeZone), 
                'itemLocID' => $itemLocID, 
                'employeeID' => auth()->user()->id
            ]);
            //$itemLoc = ItemLocation::find($itemLocID);
            //$locId = $itemLoc->locID;
            //$location = Location::find($locId);
            //$locName = $location->locName;
            //$itemNum = $itemLoc->itemNum;
            //$item = Item::find($itemNum);
            //$itemName = $item->itemName;

            //Session::put('locations', $locName);
            //Session::put('items', $itemName);
            
            //create the shopping list in the session as an array, update the array for multiple items
            if(Session::has('scannedList')) {
                $list = session('scannedList'); 
                $list[] = $transaction;
                Session(['scannedList' => $list]);
            } else {
                Session::put('scannedList', [$transaction]);
            }
            Session::put('scanSuccess', true);
            Session::put('scanActive', false);
            
            return redirect()->route('scan');

        } catch (\Exception $e) {

            // Handle any exceptions that may occur
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
