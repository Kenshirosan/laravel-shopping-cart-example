@extends('layouts.master')

@section('content')
    <div class="container">

        <ul class=list-group>
            @if(Auth::user()->theboss)
                <a href="/restaurantpanel" class="btn btn-primary">Add a product</a>
                @foreach($yearlyTotal as $total)
                    <li class="list-group-item text-right">Total for <strong class="text text-info">{{ $total->year }}: ${{ $total->total }}</strong></li>
                @endforeach
                @foreach ($totalOrders as $monthlyTotal)

                    <li class="list-group-item text-right">
                        <h4> Total for {{ $monthlyTotal->month }}:</h4>
                        <p>Total orders including taxes for {{ $monthlyTotal->month }} : ${{ $monthlyTotal->total }}</p>
                    </li>
                @endforeach
                @foreach( $orders as $order )
                    <li class="list-group-item">
                        <h4>Latest Orders: {{ $order->id }}</h4>
                        <p>{{ $order->name }} {{ $order->last_name }} paid $<strong>{{ $order->price }}</strong> for {{ $order->items }} on <strong>{{ $order->created_at->toFormattedDateString() }}</strong> at {{ $order->created_at->toTimeString() }}
                        </p>
                    </li>
                @endforeach
            </ul>
            {{ $orders->links() }}
        @elseif( (!Auth::user()->theboss) || (!Auth::user()->employee) )

            <script type="text/javascript">
            window.location = "{{ url('/shop') }}";
            </script>
        @endif


    </div>
@endsection
