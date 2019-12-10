@extends('layouts.mainLayout')

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
                    <button class="btn small" id="Select_month" data-date-format="yyyy-mm-dd" data-date="2012-02-20">Select</button>
{{--                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Add New Admin</button>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table id="employeeWorkTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Full name</th>
{{--                            <th>Project</th>--}}
{{--                            <th>Feature</th>--}}
{{--                            <th>Time Allocated</th>--}}
{{--                            <th>Time Declare</th>--}}
{{--                            <th>State</th>--}}
{{--                            <th>Start Time</th>--}}
{{--                            <th>End Time</th>--}}
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
        .on('changeDate', function(ev){
            $('#Select_month').datepicker('hide');
            console.log($(this).datepicker('getDate'));
            // alert(ev.date.formatDate/("yy-mm-dd"));
        });

        $(document).ready(function() {
            dataTable=  $('#employeeWorkTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                ordering:false,
                // type:"POST",
                "ajax":{
                    "url": "{!! route('team.work.data') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                        d.date=$('#Select_month').datepicker('getDate');
                    },
                },
                columns: [
                    { data: 'fullName', name: 'user.fullName' },
                    // { data: 'project_type', name: 'project.project_type' },
                    // { data: 'statusData', name: 'status.statusData' },
                    // { data: 'fullName', name: 'user.fullName' },
                    // { data: 'clientName', name: 'client.clientName' },
                ]
            } );
        } );

    </script>
@endsection
