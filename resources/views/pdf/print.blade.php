@extends('adminlte::page')
@section('title')
    Print Order
@endsection

@section('content')
<div class="row">
    <div class="text-center">
        <a href="/customer-orders" class="btn btn-success btn-lg"><h1>Go Back</h1></a>
    </div>
    <div class="col-md-12">
        @if($order->order_type === 'Pick-up')
            <h1 class="text-danger text-center">
                <strong>{{ $order->order_type }} at {{ $order->pickup_time }}</strong>
            </h1>
        @endif
        <table class="table">
            <th><strong>Name</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>Order Items</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>Phone</strong></th>
            <th><strong>Total</strong></th>
            <tr>
                <td><h4 class="text-info">{{ $order->name }}</h4></td>
                <td><h4 class="text-info">{{ $order->last_name }}</h4></td>
                @foreach ($items as $item)
                    <td><h4><strong class="text-primary">{{ $item }}</strong></h4></td>
                @endforeach
                <td><h4 class="text-info">{{ $order->email }}</h4></td>
                <td><h4 class="text-info">{{ $order->phone_number }}</h4></td>
                <td><h4 class="text-info">{{ $order->price() }}</h4></td>
            </tr>
        </table>
        @if($order->comments != null)
            <div class="row">
                <div class="col-md-6">
                    <h4>Comments :</h4>
                    <p class="text-info">{{ $order->comments }}</p>
                </div>
            </div>
        @endif
        <div class="spacer"></div>
        <hr>
        <a href="/print/{{ $order->id }}" class="btn btn-success">Print</a>
    </div>
    @if($order->order_type === 'Delivery')
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-body">
                    <form action="/update/order/{{ $order->id }}/status" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="status_id" class="control-label col-lg-3">Status</label>
                            <div class="controls col-lg-4"></div>
                            <select name="status_id" id="status_id" class="dropdown-style input-field input-normal">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id}}" {{  $currentStatus == $status->id ? "selected":"" }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="controls col-lg-8">
                                <div class="form-actions">
                                    <button type="submit" id="update-order" class="btn btn-success">Update Status</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
