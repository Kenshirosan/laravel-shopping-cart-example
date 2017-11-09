@extends('adminlte::page')

@section('title')
    Analytics
@endsection

@section('content')

    <p>Visitors per month</p>

    <div class="col-md-12">
            {{-- <li class="list-group-item"> --}}
                <div id="curve_chart" style="width: 100%; height: 500px"></div>
            {{-- </li> --}}
        </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Year', 'sessions','pageviews'],
                @foreach ($analyticsData as $analytics)
                ['{{ $analytics[0] = preg_replace("/(\d{4})/", "$1-", $analytics[0]) }}',  {{ $analytics[1] }}, {{ $analytics[2] }} ],
                @endforeach

            ]);

            var options = {
                title: 'Visitors',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
        </script>

@endsection