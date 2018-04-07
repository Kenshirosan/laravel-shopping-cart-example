@extends('adminlte::page')

<meta http-equiv="refresh" content="30" >

@section('title')
    Customer's order
@endsection

@section('content')
<div class="col-md-6 col-md-offset-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="btn btn-lg btn-default pull-right"><a href="/calendar">Calendar</a></h2>
            <h1 class="text-info text-center">Today's Orders</h1>
        </div>
        <div class="mb-100"></div>
    </div>
        <ul class=list-group>
        @if(!$orders->isEmpty())
            @foreach( $orders as $order )
                @if($order->hiddenOrder())
                    <form action="/show-order/{{ $order->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="hidden" value="{{ $order->id }}" name="id">
                        <input type="hidden" value="{{ $order->name }}" name="name">
                        <input type="hidden" value="{{ $order->address }}" name="address">
                        <p class="text-right"><input type="submit" class="btn btn-info btn-sm" value="show"> Order {{ $order->id }}</p>
                    </form>

                    @else

                    <li class="list-group-item hideable">
                        <a href="/order/{{ $order->id }}" class="admin-links">
                            <h4 class="admin-links">Order: {{ $order->id }}</h4>
                            <p><strong>{{ $order->order_type }}</strong></p>
                            <p>
                            {{ $order->name }} {{ $order->last_name }} paid <strong>{{ $order->price() }}</strong> for {{ regex($order->items) }} on <strong>{{ $order->created_at->toFormattedDateString() }}</strong> at {{ $order->created_at->toTimeString() }}
                            </p>
                        </a>

                        <p class="text-right">
                            <a href="/order/{{ $order->id }}" class="btn btn-primary btn-sm">View order</a>
                        </p>
                        <form action="/hide-orders/{{ $order->id }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $order->id }}" name="id">
                            <input type="hidden" value="{{ $order->name }}" name="name">
                            <input type="hidden" value="{{ $order->address }}" name="address">
                            <p class="text-right"><input type="submit" class="btn btn-danger btn-sm" value="Hide"></p>
                        </form>
                    </li>
                    @endif
            @endforeach
            <p class="text-info">
                {{ $order->numberOfOrdersProcessedToday() }}
                {{ str_plural('order', $order->numberOfOrdersProcessedToday()) }} processed today
            </p>

            @elseif($orders->isEmpty())
                <li class="list-group-item">
                    <h2 class="text-info text-center">
                        <strong>No orders yet</strong>
                    </h2>
                </li>
            @endif
    </ul>
</div>
@endsection