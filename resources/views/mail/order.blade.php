<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Your order</title>
    </head>
    <body>
        {{-- Style this however you want --}}
        <h1>Thanks for ordering with us.</h1>
        <h2>Here's your invoice</h2>
        ${{ $order->price }}
        <br>
        {{ $order->items }}
    </body>
</html>
