
<x-mail::message>

Low Supply: the following items have been scanned...


<ul>
     <li>{{ $transaction->getLowSupplyMessage() }}</li>
</ul>


Check available inventory at {{ $transaction->getLocationName() }} or click below to place an order with {{ $transaction->getVendor()->vendorName }}. 

<x-mail::button :url="$url">
Place Order
</x-mail::button>


{{ config('app.name') }}
</x-mail::message>