@extends('adminlte::page')

@section('title')
    Your business
@endsection
@section('content')

<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4>Average Orders this year:</h4>
        </div>
        <div class="panel-body">
            @foreach($averageOrder->chunk(4) as $order)
                <div class="col-xs-2">
                    <ul class="list-group">
                        @foreach ($order as $averageOrder)
                            <li class="list-group-item">
                                <p class=" text-primary">Average Order for {{ $averageOrder['month'] }} {{ $averageOrder['year'] }} : ${{ $averageOrder['Average'] / 100 }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <ul class="list-group" style="list-style: none">
            <li><a href="/restaurantpanel" class="btn btn-primary">Add a product</a></li>
            <li><a href="/best-customers" class="btn btn-primary">See your best customers</a></li>
            <li><a href="/search-orders" class="btn btn-success">Search for a specific order</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <ul class=list-group>
        @foreach($yearlyTotal as $total)
            <li class="list-group-item">
                <p><strong>Total for
                    <span class="text text-info">
                        {{ $total->year }}: </span><em class="text text-success">${{ $total->total /100 }}</em>
                    </strong>
                </p>
            </li>
            <li class="list-group-item">
                <p><strong>Sales Tax :</strong>
                    <em class="text-danger">
                        ${{ ($total->total /100) * 0.08 }}
                    </em>
                </p>
            </li>
        @endforeach
    </ul>
    <div class="row">
        <div class="col-md-6">
            <monthly-stats
                :labels="{{ $totalOrders->keys() }}"
                :values="{{ $totalOrders->values() }}"
                :taxes="{{ $taxcollection->values()}}">
            </monthly-stats>
        </div>
        <div class="col-md-6">
            <yearly-stats
                @foreach ($yearlyTotal as $total)
                    :labels="['{{ $total->year }}']"
                    :values="[{{ $total->total /100 }}]"
                    :taxes="[{{ $total->total /100 }} *0.08]"
                    :raw="[{{ $total->total/100 }} - ({{ $total->total /100 }} * 0.08)]">
                @endforeach
            </yearly-stats>
        </div>
    </div>
</div>
@endsection