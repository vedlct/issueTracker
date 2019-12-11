@extends('layouts.mainLayout')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
    <style>
        @media only screen and (min-width: 338px) and (max-width: 379px){
            .top{
                margin-top: 20%;
            }

        }
        @media only screen and (max-width: 337px){
            .top1{
                margin-top: 60%;
            }

        }
    </style>

    <div class="container-fluid">
        <div class="card top top1">
            <div class="card-header">
                <h4 class="float-left">Employee Work</h4>
                <div class="pull-right">
{{--                    <button class="btn btn-sm btn-success" id="Select_month">Select Month</button>--}}
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table id="employeeWorkTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Full name</th>
                            <th>Project</th>
                            <th>Feature</th>
                            <th>Time Allocated</th>
                            <th>Time Declare</th>
                            <th>State</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        $(document).ready(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);

            table(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));

            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                table(picker.startDate.format('YYYY-MM-DD'),picker.endDate.format('YYYY-MM-DD'));
            });
        } );

        function table(start_,end_) {
            dataTable = $('#employeeWorkTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                ordering: false,
                "bDestroy": true,
                "ajax": {
                    "url": "{!! route('team.work.data') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                        d.start_date = start_;
                        d.end_date = end_;
                    }
                },
                columns: [
                    {data: 'fullName', name: 'user.fullName'},
                    {data: 'project_name', name: 'project.project_name'},
                    {data: 'backlog_title', name: 'backlog.backlog_title'},
                    {data: 'backlog_time', name: 'backlog.backlog_time'},
                    {data: 'hour', name: 'backlog_time_chart.hour'},
                    {data: 'backlog_state', name: 'backlog.backlog_state'},
                    {data: 'backlog_start_date', name: 'backlog.backlog_start_date'},
                    {data: 'backlog_end_date', name: 'backlog.backlog_end_date'},
                ]
            });
        }
    </script>
@endsection
