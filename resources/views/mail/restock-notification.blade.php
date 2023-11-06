
<x-mail::message>

Low Supply: the following items have been scanned...


<ul>
    @foreach ($transactions as $transaction)
        <li>{{ $transaction->getMessage() }}</li>
    @endforeach
</ul>


Check available inventory in overflow supply room or click below to place an order with Boundtree. 

<x-mail::button :url="$url">
Place Order
</x-mail::button>


{{ config('app.name') }}
</x-mail::message>