@extends('layouts.mainLayout')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">Employee Work</h4>
                <div class="pull-right">
                    <button class="btn btn-sm btn-success" id="Select_month">Select Month</button>
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
    <script>
        $('#Select_month').datepicker({
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months"
        })
        .on('changeDate', function(){
            $('#Select_month').datepicker('hide');
            dataTable.ajax.reload();
        });

        $(document).ready(function() {
            dataTable = $('#employeeWorkTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                ordering:false,
                "ajax":{
                    "url": "{!! route('team.work.data') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        var jsDate = $('#Select_month').datepicker('getDate');
                        if (jsDate !== null) {
                            jsDate instanceof Date;
                            d.month = jsDate.getMonth() + 1;
                        }
                    },
                },
                columns: [
                    { data: 'fullName', name: 'user.fullName' },
                    { data: 'project_name', name: 'project.project_name' },
                    { data: 'backlog_title', name: 'backlog.backlog_title' },
                    { data: 'backlog_time', name: 'backlog.backlog_time' },
                    { data: 'declare_hour', name: 'backlog_time_chart.hour' },
                    { data: 'backlog_state', name: 'backlog.backlog_state' },
                    { data: 'backlog_start_date', name: 'backlog.backlog_start_date' },
                    { data: 'backlog_end_date', name: 'backlog.backlog_end_date' },
                ]
            } );
        } );

    </script>
@endsection
