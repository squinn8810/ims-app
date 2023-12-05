<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\ReorderMail;
use App\Models\Transaction;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    /**
     * Send restock notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restockNotification(Request $request)
    {
        $list = [];
        try {
            // Check if the scannedList exists in the session
            if (session()->has('scannedList')) {
                // Retrieve locations and items from the session data stack
                while (session()->has('scannedList')) {
                    $list = Session::pull('scannedList');
                }

                // Reconcile inventory based on scanned list and request data
                $this->reconcileInventory($list, $request);

                // Send restock notification email
                $this->makeNotification($request, $list);

                // Return success response
                return response()->json(['message' => 'Restock notification sent successfully'], Response::HTTP_OK);
            }
        } catch (Exception $e) {
            // Save the scannedList back to the session in case of an error
            Session(['scannedList' => $list]);

            // Return failure response
            return response()->json([
                'error' => [
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Error sending restock notification: ' . $e->getMessage(),
                ],
            ]);
        }
    }

    /**
     * Reconcile inventory based on the scanned list and request data.
     *
     * @param  array  $list
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function reconcileInventory(array $list, Request $request)
    {
        foreach ($list as $scan) {
            $itemLocID = $scan->itemLocID;

            // Retrieve the last transaction for the item location
            $lastTransaction = Transaction::where('itemLocID', $itemLocID)
                ->latest('transDate')
                ->skip(1) 
                ->take(1)
                ->first();

            // Retrieve the item location
            $item = ItemLocation::find($itemLocID);

            if ($lastTransaction) {
                if ($item) {
                    // Update the item quantity in the ItemLocation
                    $item->update(['itemQty' => $request->itemQty]);
                } else {
                    // Return an error response if the item is not found at the location
                    return response()->json(
                        [
                            'error' => 'Item not found at location.'
                        ],
                        Response::HTTP_NOT_FOUND
                    );
                }
                $lastQty = $lastTransaction->itemQty;
                $changeQty = (int)$request->itemQty - $lastQty;
                // Update the transaction with the new item quantity
                $transaction = Transaction::findOrFail($scan->transNum);
                $transaction->update([
                    "itemQty" => $changeQty
                ]);
            } else {
                // First transaction case or no others found
                $lastQty = $item->itemQty;
                $changeQty = (int)$request->itemQty - $lastQty;

                // Update the transaction with the new item quantity
                $transaction = Transaction::findOrFail($scan->transNum);
                $transaction->update([
                    "itemQty" => $changeQty
                ]);
            }
        }
    }

    /**
     * Make and send the restock notification email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $list
     * @return void
     */
    private function makeNotification(Request $request, array $list)
    {
        // Create a new ReorderMail instance with the list of transactions
        $email = new ReorderMail($list);

        // Update the recipient email address if needed
        Mail::to("squinn8810@gmail.com")->send($email);
    }
}
