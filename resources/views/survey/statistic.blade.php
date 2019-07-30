@extends('layouts.app')

@section('content')
    <h3 class="text-center">Statistic</h3>

    <div class="row justify-content-center" id="charts">
        <div id="chart" style="width: 700px; height: 400px">
            @foreach($charts as $chart)
                {!! $chart->container() !!}
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    @foreach($charts as $chart)
        {!! $chart->script() !!}
    @endforeach
@endsection