@extends('adminlte::page')
@section('title')
    Print Order
@endsection

@section('content')
    @if( Auth::user()->isAdmin() || Auth::user()->employee )

    <div class="col-md-6">
        @foreach ($items as $item)

            <h4 class="text-danger" style="display:inline; margin-left:1em;">{{ $item }}</h4>

        @endforeach

        <table class="table">
            <th><strong>Name</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>Phone</strong></th>
            <th><strong>Total</strong></th>
            <tr>
                <td><h4 class="text-info">{{ $order->name }}</h4></td>

                <td><h4 class="text-info">{{ $order->last_name }}</h4></td>

                <td><h4 class="text-info">{{ $order->email }}</h4></td>

                <td><h4 class="text-info">{{ $order->phone_number }}</h4></td>

                <td><h4 class="text-info">${{ $order->price /100 }}</h4></td>
            </tr>
        </table>

        <div class="spacer"></div>
        <hr>
        <a href="/print/{{ $order->id }}" class="btn btn-success">Print</a>

        {{-- not implemented fully: route missing, feature in PaymentController but should be moved to OrderProcessedController --}}
        {{-- <a href="/delete/{{ $order->id }}" class="btn btn-danger pull-right">Delete</a> --}}
    </div>
    @elseif( !Auth::user()->isAdmin() || !Auth::user()->employee)
        <script type="text/javascript">
            window.location = "{{ url('/shop') }}";
        </script>
    @endif

@endsection
