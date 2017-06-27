@extends('layouts.master')

@section('content')
    <div class="container">

        <ul class=list-group>
            @if(Auth::user()->theboss)
                <li class="list-group-item"><a href="/restaurantpanel" class="btn btn-primary">Add a product</a><p class="pull-right">Total orders including taxes : ${{ $price }}</p></li>
                @foreach( $orders as $order )
                    <li class="list-group-item"><h4>Latest Orders: {{ $order->id }}</h4>{{ $order->name }} {{ $order->last_name }} paid $<strong>{{ $order->price }}</strong> for {{ $order->items }} on <strong>{{ $order->created_at->toFormattedDateString() }}</strong> at {{    $order->created_at->toTimeString() }}</li>
                @endforeach
                </ul>
            @elseif( (!Auth::user()->theboss) || (!Auth::user()->employee) )

                <script type="text/javascript">
                window.location = "{{ url('/shop') }}";
                </script>
            @endif


    </div>
@endsection
