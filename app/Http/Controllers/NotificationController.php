<?php

namespace App\Http\Controllers;

use App\Mail\ReorderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{

    /**
     * Send restock notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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
            $this->makeNotification($list);

            // Flash a success message and redirect to the scan route
            session()->flash('success', 'Notification Sent!');
            session()->forget('scanSuccess');
            return redirect()->route('scan');
        }

        // Flash a fail message if 'scannedList' session is empty and redirect to the scan route
        session()->flash('fail', 'Scan an item first...');
        return redirect()->route('scan');
    }

    /**
     * Make and send the restock notification.
     *
     * @param  array  $list
     * @return void
     */
    public function makeNotification(array $list)
    {
        // Create a new ReorderMail instance with the list of transactions
        $email = new ReorderMail($list);

        // Update the recipient email address if needed
        Mail::to('squinn8810@gmail.com')->send($email);
    }
}
