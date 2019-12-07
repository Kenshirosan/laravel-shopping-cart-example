@component('mail::message')

# Thank you for ordering with us !

You paid : {{ $order->price() }} for

@foreach($order->products as $order_detail)
    {{ $order_detail['qty'] }}
    {{ $order_detail['product_name'] }}
    @if($order_detail['options']) {{ $order_detail['options'] }} @endif
    @if($order_detail['wayofcooking'])Cooked: {{ $order_detail['wayofcooking'] }} @endif
@endforeach

@if($order->order_type === 'Pick-up')
	Pick up at: {{ $order->pickup_time }}
@endif
<br>

You may review and print your invoice online on your profile page.

Thanks, <br>

{{ config('app.name') }}
@endcomponent