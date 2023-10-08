<?php

namespace App\Http\Controllers;

use App\Mail\ReorderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{

    public function restockNotification(Request $request)
    {

        $locations = array();
        $items = array();

        if (session()->has('locations') && session()->has('items')) {

            // Grab the locations and items from the session data stack
            while (session()->has('locations') && session()->has('items')) {
                $locations[] = Session::pull('locations');
                $items[] = Session::pull('items');
            }

            // Build the message

            $name = auth()->user()->firstName;
            $message = "The following items have scanned from $locations[0] by $name: ";
            $messages[] = $message;

            foreach ($items as $item) {
                $messages[] = "$item";
                
            }

            // Call the makeNotification method with the messages
            $this->makeNotification($messages);
            session()->flash('success', 'Notification Sent');
            return redirect()->route('scan')->with('email_message', $messages);
        }

        return redirect()->route('scan');
    }

    public function makeNotification(array $messages)
    {
        // Mail logic
        $email = new ReorderMail($messages);

        // Update the recipient email address
        Mail::to('squinn8810@gmail.com')->send($email);
    }
}
