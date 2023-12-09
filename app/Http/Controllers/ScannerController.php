<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemLocationResource;
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
    public function scanToSession(Request $request)
    {
        // Get the JSON data from the request body
        $requestData = json_decode($request->getContent(), true);

        // Extract the scan data from the JSON request
        $results = $requestData['scanData'];

        // Extract the item location ID from the scanned data
        $itemLocID = $results;


        $item = ItemLocation::find($itemLocID);
        $itemLocationResource = new ItemLocationResource($item);

        
        // Create or update the shopping list in the session
        if (Session::has('scannedList')) {
            $list = session('scannedList');
            $list[] = $itemLocationResource;
            Session(['scannedList' => $list]);
        } else {
            Session::put('scannedList', [$itemLocationResource]);
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
}
