<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\ItemLocation;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Response;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        //update item at location qty
        /*if ($requestData['itemQty'] != null) {
            $itemQty = $requestData['itemQty'];
            $difference = $this->reconcileInventory($itemQty, $itemLocID);
        }*/

        //create transaction with difference item qty at location
        /*$transaction = $this->store($itemLocID, $difference);
        */ 
        
        $transactionResource = $this->store($itemLocID);
        // Create or update the shopping list in the session
        if (Session::has('scannedList')) {
            $list = session('scannedList');
            $list[] = $transactionResource;
            Session(['scannedList' => $list]);
        } else {
            Session::put('scannedList', [$transactionResource]);
        }

        // Set session flags to indicate successful scan and deactivate scanning
        Session::put('scanSuccess', true);
        Session::put('scanActive', false);


        // Return the scan result from session
        return response()->json(
            [
                'scannedList' => session('scannedList')
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Return scannedList saved in the session or 404 if no list is found.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getScannedList(Request $request)
    {
        if (Session::has('scannedList')) {
            return response()->json(
                [
                    'scannedList' => session('scannedList')
                ],
                Response::HTTP_OK
            );
        }
        return response()->json(Response::HTTP_NOT_FOUND);
    }

    /**
     * 
     */
    private function reconcileInventory($itemQty, $itemLocID)
    {
        $lastTransaction = Transaction::where('itemLocID', $itemLocID)
            ->latest('transDate')
            ->first();
        
        $item = ItemLocation::find($itemLocID);

        if ($lastTransaction) {
            $lastQty = $lastTransaction->itemQty; 
    
            if ($item) {
                $item->update(['itemQty' => $itemQty]);
            } else {
                return response()->json(
                    [
                        'error' => 'Item not found at location.'
                    ],
                    Response::HTTP_NOT_FOUND);
            }
            return $itemQty - $lastQty;
        } else {
            //first transaction case or no others found
            $lastQty = $item->itemQty;
            return $itemQty - $lastQty;
        }
    }


    /**
     * 
     */
    private function store($itemLocID /* , $difference*/)
    {

        $easternTimeZone = new DateTimeZone('America/New_York');
        $transaction = Transaction::create([
            'transDate' => new DateTime('now', $easternTimeZone),
            'itemLocID' => $itemLocID,
            'employeeID' => auth()->user()->id,
            //'itemQty' => $difference,
        ]);
        $resource = new TransactionResource($transaction);

        return $resource;
    }
}
