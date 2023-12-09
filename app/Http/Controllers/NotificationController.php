<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use DateTimeZone;
use App\Mail\ReorderMail;
use App\Models\Transaction;
use App\Models\ItemLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\TransactionResource;

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
                $transactions = $this->reconcileInventory($list, $request);

                // Send restock notification email
                $this->makeNotification($transactions);

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
        $transactions = [];

        foreach ($list as $scan) {
            $itemLocID = $scan->itemLocID;

            // Retrieve the last transaction for the item location
            $lastTransaction = Transaction::where('itemLocID', $itemLocID)
                ->latest('transDate')
                ->first();


            if ($lastTransaction) {

                $lastQty = $scan->itemQty;
                $changeQty = (int)$request->itemQty - $lastQty;

                $scan->update(['itemQty' => $request->itemQty]);
                $transactions[] = $this->store($scan->itemLocID, $changeQty);
            } else {
                // First transaction case or no others found
                $lastQty = $scan->itemQty;
                $changeQty = (int)$request->itemQty - $lastQty;

                $scan->update(['itemQty' => $request->itemQty]);
                $transactions[] = $this->store($scan->itemLocID, $changeQty);
            }
        }

        return $transactions;
    }

    private function store($itemLocID, $changeQty)
    {

        $easternTimeZone = new DateTimeZone('America/New_York');
        $transaction = Transaction::create([
            'transDate' => new DateTime('now', $easternTimeZone),
            'itemLocID' => $itemLocID,
            'employeeID' => auth()->user()->id,
            'itemQty' => $changeQty,
        ]);
        $resource = new TransactionResource($transaction);

        return $resource;
    }

    /**
     * Make and send the restock notification email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $list
     * @return void
     */
    private function makeNotification($list)
    {
        // Create a new ReorderMail instance with the list of transactions
        $email = new ReorderMail($list);

        // Update the recipient email address if needed
        Mail::to("squinn8810@gmail.com")->send($email);
    }
}
