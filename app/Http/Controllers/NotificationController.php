<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use DateTimeZone;
use App\Mail\LowSupplyMail;
use App\Mail\RestockMail;
use App\Models\Transaction;
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
    public function lowSupplyNotification(Request $request)
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
                $transaction = $this->reconcileInventory($list, $request);

                // Send restock notification email
                $this->makeLowSupplyNotification($transaction);

                // Return success response
                return response()->json(['message' => 'Resupply alert sent successfully'], Response::HTTP_OK);
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
                $transaction = $this->addToInventory($list, $request);

                // Send restock notification email
                $this->makeRestockNotification($transaction);

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
    private function addToInventory(array $list, Request $request)
    {
        $transactions = [];

        foreach ($list as $scan) {
            $itemLocID = $scan->itemLocID;

            $lastQty = $scan->itemQty;
            $addedQty = (int)$request->itemQty;

            $newQty = $lastQty + $addedQty;

            $lastTransaction = Transaction::where('itemLocID', $itemLocID)
                ->latest('transDate')
                ->first();

            $lastTransaction->update(['status' => 'complete']);

            $scan->update(['itemQty' => $newQty]);
            $transactions[] = $this->store($scan->itemLocID, $addedQty, 'complete');
        }


        return $transactions;
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
                $transactions[] = $this->store($scan->itemLocID, $changeQty, "pending");
            } else {
                // First transaction case or no others found
                $lastQty = $scan->itemQty;
                $changeQty = (int)$request->itemQty - $lastQty;

                $scan->update(['itemQty' => $request->itemQty]);
                $transactions[] = $this->store($scan->itemLocID, $changeQty, 'pending');
            }
        }

        return $transactions;
    }

    private function store($itemLocID, $changeQty, $status)
    {

        $easternTimeZone = new DateTimeZone('America/New_York');
        $transaction = Transaction::create([
            'transDate' => new DateTime('now', $easternTimeZone),
            'itemLocID' => $itemLocID,
            'employeeID' => auth()->user()->id,
            'itemQty' => $changeQty,
            'status' => $status,
        ]);

        return $transaction;
    }

    /**
     * Make and send the resupply notification email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $list
     * @return void
     */
    private function makeLowSupplyNotification($transaction)
    {
        // Create a new ReorderMail instance with the list of transactions
        $email = new LowSupplyMail($transaction);

        // Update the recipient email address if needed
        Mail::to("squinn8810@gmail.com")->send($email);
    }

    /**
     * Make and send the restock notification email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $list
     * @return void
     */
    private function makeRestockNotification($transaction)
    {
        // Create a new RestockMail instance with the list of transactions
        $email = new RestockMail($transaction);

        // Update the recipient email address if needed
        Mail::to("squinn8810@gmail.com")->send($email);
    }
}
