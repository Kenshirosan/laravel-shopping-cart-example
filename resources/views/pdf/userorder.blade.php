@extends('layouts.master')

@section('title')
    Customer's order
@endsection

@section('content')
    @if ( Auth::user()->theboss || Auth::user()->employee)
        <h4 class="text-center">Today's Order</h4>
        <ul class=list-group>

            @foreach( $orders as $order )
                <li class="list-group-item">
                    <a href="/order/{{ $order->id }}" class="admin-links"><h4>Order: {{ $order->id }}</h4>
                    <p>{{ $order->name }} {{ $order->last_name }} paid $<strong>{{ $order->price /100}}</strong> for {{ $order->items }} on <strong>{{ $order->created_at->toFormattedDateString() }}</strong> at {{ $order->created_at->toTimeString() }}
                    </p></a>
                    <p class="text-right"><a href="/order/{{ $order->id }}" class="btn btn-primary">View order</a></p>

                </li>

            @endforeach
        </ul>
    @elseif( !Auth::user()->isAdmin() || !Auth::user()->employee)
        <script type="text/javascript">
        window.location = "{{ url('/shop') }}";
        </script>
    @endif
@endsection
