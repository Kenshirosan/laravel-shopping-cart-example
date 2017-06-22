<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Your order</title>
    </head>
    <style>
        /*Style this however you want*/
    </style>
    <body>

        <h1>Thanks for ordering with us.</h1>
        <h2>Here's your invoice</h2>
        ${{ $order->price }}
        <br>
        {{ $order->items }}
    </body>
</html>
