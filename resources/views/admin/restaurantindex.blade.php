@extends('adminlte::page')

@section('content')
<div class="row">
    <h1 class="text-primary text-center">Hello, {{ Auth::user()->name }}</h1>
    <hr>
    @include('includes.addProductForm')
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="panel panel-info">
            @foreach( $orders as $order )
            <div class="panel-heading">
                <h4>Latest Orders: {{ $order->id }}</h4>
            </div>
            <div class="panel-body">
                <p>{{ $order->name }} {{ $order->last_name }} paid $<strong>{{ $order->price /100 }}</strong> for {{ preg_replace('/[]["]/ ', '', $order->items) }} on <strong>{{ $order->created_at->toFormattedDateString() }}</strong> at {{    $order->created_at->toTimeString() }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
