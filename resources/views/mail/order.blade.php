@component('mail::message')

# Thank you for ordering with us !

You paid : {{ $order->price() }} for {{ regex($order->items) }}

@if($order->order_type === 'Pick-up')
	Pick up at: {{ $order->pickup_time }}
@endif
<br>

You may review and print your invoice online on your profile page.

Thanks, <br>

{{ config('app.name') }}
@endcomponent