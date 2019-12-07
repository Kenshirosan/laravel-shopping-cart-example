<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Order</title>
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>
    <header>
        <h1>Your restaurant Name</h1>
        <h4>{{ $order->order_type }}</h4>
        @if($order->order_type === 'Pick-up')
            <h4>Pickup time : {{ $order->pickup_time }}</h4>
        @endif
        <h3>Order number: 00{{ $order->created_at->format('Ym') . $order->id }}</h3>
        <h3><strong class="text-info">{{ $order->name }} {{ $order->last_name }}</strong></h3>
        <p><small class="text-info">{{ $order->email }}</small></p>
        <p><small class="text-info">{{ $order->phone_number }}</small></p>
    </header>


    <div class="spacer"></div>
        <strong>Your order:</strong>
        @foreach($order->products as $order_detail)
            <table class="table">
                <thead>
                    <tr>
                        <th><strong>Qty</strong></th>
                        <th><strong>Product</strong></th>
                        <th><strong>Options</strong></th>
                        <th><strong>Cooked</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong class="text-info">{{ $order_detail['qty'] }}</strong></td>
                        <td><strong class="text-info">{{ $order_detail['product_name'] }}</strong></td>
                        <td><strong class="text-info">{{ $order_detail['options'] ? $order_detail['options'] : 'n/a' }}</strong></td>
                        <td><strong class="text-info">{{ $order_detail['wayofcooking'] ? $order_detail['wayofcooking'] : 'n/a' }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @endforeach

    <table class="table">
        <thead>
            <tr>
                <th><strong>Subtotal</strong></th>
                <th><strong>Taxes</strong></th>
                <th><strong>Total</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong class="text-info">{{ $order->subtotal() }}</strong></td>
                <td><strong class="text-info">${{ $order->tax() }}</strong></td>
                <td><strong class="text-info">{{ $order->price() }}</strong></td>
            </tr>
        </tbody>
    </table>

    @if($order->comments != null)
        <p>Extra Comments:</p>
        <p><strong>{{ $order->comments }}</strong></p>
    @endif
    <hr>
    <p><strong>Order received on : {{ $order->created_at->format('D, F d, Y') }} at {{ $order->created_at->toTimeString() }}</strong></p>
    @include('includes.footer')
</body>
</html>
