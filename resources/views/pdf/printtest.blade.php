<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print Order</title>
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>
    <header>
        <h1>Your restaurant Name</h1>
        <h3>Order number: 00{{ $order->created_at->format('Ym') . $order->id }}</h3>
    </header>


    <table class="table">
        <thead>
            <tr>
                <th><strong>Name</strong></th>
                <th><strong>Last Name</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Phone</strong></th>
                <th><strong>Total</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td><h4 class="text-info">{{ $order->name }}</h4></td>

                <td><h4 class="text-info">{{ $order->last_name }}</h4></td>

                <td><h4 class="text-info">{{ $order->email }}</h4></td>

                <td><h4 class="text-info">{{ $order->phone_number }}</h4></td>

                <td><h4 class="text-info">${{ $order->price /100 }}</h4></td>
            </tr>
        </tbody>
    </table>
    <div class="spacer"></div>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
    <hr>
    <p><strong>Order received on : {{ $order->created_at->format('D, F d, Y') }} at : {{ $order->created_at->toTimeString() }}</strong></p>


    @include('includes.footer')
</body>
</html>
