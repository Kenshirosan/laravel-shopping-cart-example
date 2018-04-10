<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Invoice</title>
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>
    <header>
        <h1>{{ config('APP_NAME') }}</h1>
        <h3>Invoice number: 00{{ $invoice->created_at->format('Ym') . $invoice->id }}</h3>
    </header>
    <table class="table">
        <thead>
            <tr>
                <th><strong >Name</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Phone</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong class="text-info">{{ $invoice->name }} {{ $invoice->last_name }}</strong></td>
                <td><strong class="text-info">{{ $invoice->email }}</strong></td>
                <td><strong class="text-info">{{ $invoice->phone_number }}</strong></td>
            </tr>
        </tbody>
    </table>
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
                {{-- <td><strong class="text-info">{{ $invoice->subtotal() }}</strong></td>
                <td><strong class="text-info">${{ $invoice->tax() }}</strong></td> --}}
                <td><strong class="text-info">{{ $invoice->price }}</strong></td>
            </tr>
        </tbody>
    </table>
    <div class="spacer"></div>
    <ul>
    Ordered :
{{--         @foreach ($items as $item)
            <li>{{ $item }}</li>
        @endforeach --}}
    </ul>
    <hr>
    <p><strong>invoice received on : {{ $invoice->created_at->format('D, F d, Y') }} at {{ $invoice->created_at->toTimeString() }}</strong></p>
    @include('includes.footer')
</body>
</html>
