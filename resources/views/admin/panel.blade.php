@extends('adminlte::page')

@section('title')
    Your business
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <h1 class="text-center text-primary">Company Performance</h1>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Yearly Performance</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <h4>Current Year</h4>
                    <monthly-stats
                        :labels="{{ $totalOrders->keys() }}"
                        :values="{{ $totalOrders->values() }}"
                        :taxes="{{ $taxcollection->values()}}">
                    </monthly-stats>
                </div>
                <div class="col-md-6">
                    <h4>Last Year</h4>
                    <monthly-stats
                        :labels="{{ $totalOrdersYearBefore->keys() }}"
                        :values="{{ $totalOrdersYearBefore->values() }}"
                        :taxes="{{ $taxcollectionYearBefore->values()}}">
                    </monthly-stats>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Average Orders this year:</h4>
            </div>
            <div class="panel-body">
                @foreach($averageOrder->chunk(4) as $order)
                    <div class="col-md-3 col-xs-2">
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Yearly summary</h4>
            </div>
            <div class="panel-body">
                @foreach ($yearlyTotal as $total)
                    <div class="col-md-4">
                        <yearly-stats
                            :labels="['{{ $total->year }}']"
                            :values="[{{ $total->total  }}]"
                            :taxes="[{{ $total->total  }} *0.08]"
                            :profit="[{{ $total->total }} - ({{ $total->total }} * 0.08)]">
                        </yearly-stats>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Yearly summary</h4>
            </div>
            <div class="panel-body">
                @foreach($yearlyTotal as $total)
                    <ul class="list-group col-md-3 col-xs-2">
                        <li class="list-group-item">
                            <p><strong>Total for
                                <span class="text text-info">
                                    {{ $total->year }}: </span><em class="text text-success">${{ $total->total }}</em>
                                </strong>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Sales Tax :</strong>
                                <em class="text-danger">
                                    ${{ ($total->total) * 0.08 }}
                                </em>
                            </p>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection