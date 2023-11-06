<?php

namespace App\Http\Controllers;

use App\Mail\ReorderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{

    /**
     * 
     */
    public function restockNotification(Request $request)
    {

        if (session()->has('scannedList')) {

            // Grab the locations and items from the session data stack
            while (session()->has('scannedList')) {
                $list = Session::pull('scannedList');
            }

            // Call the makeNotification method with the list of transactions
            $this->makeNotification($list);
            session()->flash('success', 'Notification Sent!');
            session()->forget('scanSuccess');
            return redirect()->route('scan');
        }

        session()->flash('fail', 'Scan an item first...');


        return redirect()->route('scan');
    }

    /**
     * 
     */
    public function makeNotification(array $list)
    {
        $email = new ReorderMail($list);

        // Update the recipient email address
        Mail::to('email@email.com')->send($email);
    }
}
