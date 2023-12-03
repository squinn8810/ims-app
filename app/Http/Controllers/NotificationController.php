<?php

namespace App\Http\Controllers;

use App\Mail\ReorderMail;
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
        // Check if there's data in the 'scannedList' session
        if (session()->has('scannedList')) {
            
            // Grab the locations and items from the session data stack
            while (session()->has('scannedList')) {
                $list = Session::pull('scannedList');
            }

            // Call the makeNotification method with the list of transactions
            $this->makeNotification($request, $list);

            // Return Success
            return response(Response::HTTP_OK);
        }

        // Return Failure to send
        return response()->json([
            'error' => [
                'errors' => Response::HTTP_NOT_FOUND,
                'message' => 'No scanned list found in session.'
            ],
            'status' => Response::HTTP_NOT_FOUND,
            'statusText' => 'No scanned list found in session.',
            'name' => '404 Not Found',
            'ok' => false,
            'url' => request()->url(),
        ]);
    }

    /**
     * Make and send the restock notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $list
     * @return void
     */
    public function makeNotification(Request $request, array $list)
    {
        // Create a new ReorderMail instance with the list of transactions
        $email = new ReorderMail($list);

        // Update the recipient email address if needed
        Mail::to($request->user()->email)->send(new ReorderMail($email));
    }
}
