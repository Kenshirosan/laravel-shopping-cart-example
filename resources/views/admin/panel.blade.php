@extends('adminlte::page')

@section('title')
    Your business
@endsection
@section('content')
<style media="screen">
    .container{width:100%;}
</style>

<div class="well">
    <h4>Average Orders :</h4>

    <div class="row">
        @foreach($averageOrder->chunk(4) as $order)

            <div class="col-xs-2">
                <ul class="list-group">
                    @foreach ($order as $averageOrder)
                        <li class="list-group-item">
                            Average Order for {{ $averageOrder['month'] }} {{ $averageOrder['year'] }} : ${{ $averageOrder['Average'] / 100 }}
                        </li>
                    @endforeach
                </ul>
            </div>

        @endforeach
    </div>
</div>
<ul class=list-group>
    @if(Auth::user()->isAdmin())

        <a href="/restaurantpanel" class="btn btn-primary">Add a product</a>
        <a href="/best-customers" class="btn btn-primary">See your best customers</a>
        <a href="/search-orders" class="btn btn-success pull-right">Search for a specific order</a>

        @foreach($yearlyTotal as $total)

            <li class="list-group-item text-center">Total for <strong class="text text-info">{{ $total->year }}: ${{ $total->total /100 }}</strong> Sales Tax : <strong class="text-danger">{{ $total->total /100 * 0.08 }}</strong></li>

        @endforeach

        {{-- CHARTS --}}
        <div class="col-md-12">
            <li class="list-group-item">
                <div id="curve_chart" style="width: 100%; height: 500px"></div>
            </li>
        </div>

        <div class="col-md-12">
            <li class="list-group-item">
                <div id="columnchart_material" style="width: 100%; height: 300px;"></div>
            </li>
        </div>
</ul>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Month', 'Sales','Sales Tax'],
                @foreach ($totalOrders as $monthlyTotal)
                ['{{ $monthlyTotal->month}} {{ $monthlyTotal->year }}',  {{ $monthlyTotal->total /100 }}, {{ $monthlyTotal->total /100 * 0.08 }} ],
                @endforeach

            ]);

            var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
        </script>

        <script type="text/javascript">
        google.charts.load("current", {packages:['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Taxes', 'Raw Profit'],

                @foreach ($yearlyTotal as $total)
                ["{{ $total->year }}", {{ $total->total /100 }}, {{ $total->total /100 }} *0.08, {{ $total->total/100 }} - ({{ $total->total /100 }} * 0.08)],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit',
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_material"));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        </script>

        @elseif( !Auth::user()->isAdmin() )

            <script type="text/javascript">
                window.location = "{{ url('/shop') }}";
            </script>

        @endif
@endsection
