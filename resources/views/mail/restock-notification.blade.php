
<x-mail::message>

Restock Notification: The following items have been scanned...

<ul>
    <li>{{ $transaction->getRestockMessage() }}</li>
</ul>


Confirm available inventory at {{ $transaction->getLocationName() }} or click below to confirm order with {{ $transaction->getVendor()->vendorName }}. 

<x-mail::button :url="$url">
Confirm Order
</x-mail::button>


{{ config('app.name') }}
</x-mail::message>