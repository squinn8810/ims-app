<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Response;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Log;

class ScannerController extends Controller
{

    /**
     * Analyze the scanned data and update the session with transaction information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decode(Request $request)
    {
        // Get the JSON data from the request body
        $requestData = json_decode($request->getContent(), true);

        // Extract the scan data from the JSON request
        $results = $requestData['scanData'];

        // Extract the item location ID from the scanned data
        $itemLocID = $results;

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


        // Return the scan result from session
        return response()->json([
            'scannedList' => session('scannedList')
        ],
        Response::HTTP_OK);
    }

    /**
     * Return scannedList saved in the session or 404 if no list is found.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */    
    public function getScannedList(Request $request) {
        if (Session::has('scannedList')) {
            return response()->json([
                'scannedList' => session('scannedList')
            ],
            Response::HTTP_OK);
        }
        return response()->json([
            'error' => 'Scanned List Not Found'
        ],
        Response::HTTP_NOT_FOUND);
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
