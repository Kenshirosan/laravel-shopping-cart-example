<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome !</title>
    </head>
    <style>
         /*Style this however you want*/
    </style>
    <body>

        <h1>Thanks for signing up, {{ $user->name }}!</h1>
        <h2>You can now order for delivery !</h2>
        <p>As a reminder, we do  not store your credit card info on our server, our payment provider handles all the encryption and is fully PCI compliant.</p>
    </body>
</html>
