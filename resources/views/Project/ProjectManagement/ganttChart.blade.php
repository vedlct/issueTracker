@extends('layouts.mainLayout')


@section('css')
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
    </style>
@endsection


@section('content')

    <div class="card">
        <div class="card-header">
            Project : {{ $projectName }}
        </div>
        <div class="card-body">

            @if(count($backlogs) > 0)
                <div id="chart_div"></div>

            @else
                <p>There is no backlog yet.</p>
            @endif

        </div>
    </div>

@endsection

@section('js')


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
                  @foreach($backlogs as $backlog)
                      console.log("{{ \Carbon\Carbon::parse($backlog->backlog_start_date)->format('d') }}");
                  @endforeach

            var data = new google.visualization.DataTable();

            data.addColumn('string', 'Backlog ID');
            data.addColumn('string', 'Backlog Name');
            data.addColumn('string', 'Resource');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');

            data.addRows
            (
                [
                    @foreach($backlogs as $backlog)
                        [
                            '{{ $backlog->backlog_id }}', '{{ $backlog->backlog_title }}', null,
                                new Date({{ \Carbon\Carbon::parse($backlog->backlog_start_date)->format('Y') }},{{ \Carbon\Carbon::parse($backlog->backlog_start_date)->format('m') -1 }},{{ \Carbon\Carbon::parse($backlog->backlog_start_date)->format('d') }}),
                                new Date({{ \Carbon\Carbon::parse($backlog->backlog_end_date)->format('Y') }},{{ \Carbon\Carbon::parse($backlog->backlog_end_date)->format('m') -1 }},{{ \Carbon\Carbon::parse($backlog->backlog_end_date)->format('d') }}),
                            null, null, null
                        ],
                    @endforeach
                ]
            );

            var options = {
                height: 400,
                gantt: {
                    trackHeight: 30
                }
            };



            var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>


@endsection

