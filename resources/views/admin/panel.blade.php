@extends('layouts.master')

@section('title')
    Your business
@endsection
@section('content')
<style media="screen">
    .container{width:100%;}
</style>
    <ul class=list-group>
        @if(Auth::user()->isAdmin())

            <a href="/restaurantpanel" class="btn btn-primary">Add a product</a>
            <a href="/search-orders" class="btn btn-success pull-right">Search for a specific order</a>
            @foreach($yearlyTotal as $total)

                <li class="list-group-item text-center">Total for <strong class="text text-info">{{ $total->year }}: ${{ $total->total /100 }}</strong> Sales Tax : <strong class="text-danger">{{ $total->total /100 * 0.08 }}</strong></li>

            @endforeach

            {{-- CHARTS --}}
            <li class="list-group-item"><div id="curve_chart" style="width: 100%; height: 500px"></div></li>
            <li class="list-group-item"><div id="columnchart_material" style="width: 100%; height: 300px;"></div></li>


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
                ['Year', 'Sales', 'Taxes', 'Profit'],

                @foreach ($yearlyTotal as $total)
                ["{{ $total->year }}", {{ $total->total /100 }}, {{ $total->total /100 }} *0.08, {{ $total->total/100 }} - ({{ $total->total /100 }} * 0.08)],
                @endforeach
            ]);

            // var view = new google.visualization.DataView(data);

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
