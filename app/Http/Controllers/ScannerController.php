<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
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

    /**
     * Analyze the scanned data and update the session with transaction information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function decode(Request $request)
    {
        try {
            // Get the JSON data from the request body
            $requestData = json_decode($request->getContent(), true);

            // Extract the scan data from the JSON request
            $results = $requestData['scanData'];

            // Extract the item location ID from the scanned data
            $itemLocID = $results[1];

            $transaction = $this->store($itemLocID);

            // Create or update the shopping list in the session
            if (Session::has('scannedList')) {
                $list = session('scannedList');
                $list[] = $transaction;
                Session(['scannedList' => $list]);
            } else {
                Session::put('scannedList', [$transaction]);
            }

            // Set session flags to indicate successful scan and deactivate scanning
            Session::put('scanSuccess', true);
            Session::put('scanActive', false);

            //TO DO FOR SCANNER 
            //reconcile item_location quantity 
            //  capture current inventory quantity 
            //  capture change in inventory since last reconcile 
            //pass both to transaction record
            //pass current inventory quantity to item_location







            // Redirect to the scan route
            return redirect()->route('scan');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur and return an error response
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }


    /**
     * 
     */
    private function store($itemLocID)
    {

        $easternTimeZone = new DateTimeZone('America/New_York');
        $transaction = Transaction::create([
            'transDate' => new DateTime('now', $easternTimeZone),
            'itemLocID' => $itemLocID,
            'employeeID' => auth()->user()->id
        ]);

        $resource = new TransactionResource($transaction);

        return $resource;
    }
}
