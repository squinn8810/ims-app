
<x-mail::message>

SFD Supply Message

@foreach ($messages as $message)
    {{ $message }}
@endforeach

Check available inventory in overflow supply room or click below to place an order with Boundtree. 

<x-mail::button :url="$url">
Place Order
</x-mail::button>


{{ config('app.name') }}
</x-mail::message>