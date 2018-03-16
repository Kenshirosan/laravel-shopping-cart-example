@component('mail::message')

# Thank you for ordering with us !

You paid : {{ $order->price() }} for {{ regex($order->items) }}

<br>

You may review and print your invoice online on your profile page.

Thanks, <br>

{{ config('app.name') }}
@endcomponent