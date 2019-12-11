@extends('layouts.mainLayout')


@section('css')
    <style>
        tr{
            text-align: center;
        }
    </style>
@endsection


@section('content')
    <style>
        @media only screen and (max-width: 395px){
            .top{
                margin-top: 8%;
            }

        }
        @media only screen and (min-width: 397px) and (max-width: 540px){
            .top1{
                margin-top: 5%;
            }

        }
        @media only screen and (min-width: 540px) and (max-width: 709px){
            .top2{
                margin-top: 5%;
            }

        }
        @media only screen and (min-width: 769px) and (max-width: 948px){
            .top3{
                margin-top: 5%;
            }

        }
        @media only screen and (min-width: 370px) and (max-width: 400px){
            .top4{
                margin-top: 0%;
                margin-left: 10%;
            }

        }
    </style>
    <style>
        @media only screen and (min-width: 338px) and (max-width: 379px){
            .top5{
                margin-top: 20%;
            }

        }
        @media only screen and (max-width: 337px){
            .top6{
                margin-top: 60%;
            }

        }
    </style>


    <div class="card top5 top6">
        <h5 class="card-header mt-0">
            <div class="row">
                <div class="col-md-3 col-sm-3">
            {{ $project->project_name }}
                </div>
                <div class="col-md-9 col-sm-9">
            <a class="btn btn-primary btn-sm pull-right ml-2" href="{{ route('project.features', $project->projectId) }}">Dashboard</a>
            <a class="btn btn-primary btn-sm pull-right ml-2 top top4" href="{{ route('project.projectmanagement', $project_id) }}">ADD FEATURE (ADVANCE)</a>
            <a class="btn btn-sm btn-secondary pull-right top top1 top2 top3" style="color: white" onclick="generateReport()">Generate Project Excel</a>
                </div>
            </div>
        </h5>

        <div class="card-body">
            <div class="table table-responsive">
            <table class="table table-bordered table-sm table-condensed">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col">#</th>
                        <th scope="col">Feature *</th>
                        <th scope="col">Hour</th>
                        <th scope="col">Feature State</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Remark</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td> <button class="btn btn-sm btn-primary pull-right" onclick="addBacklog()">ADD</button> </td>
                        <td> <input type="text" class="form-control" placeholder="Feature Name" id="backlog" required> </td>
                        <td> <input type="number" class="form-control" placeholder="Expected Time" id="time"> </td>
                        <td>
                            <select class="form-control pull-right" id="backlog_state" required>
                                <option value="Planned" selected>Planned</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Code Done">Code Done</option>
                                <option value="Testing">Testing</option>
                                <option value="Complete">Complete</option>
                            </select>
                        </td>
                        <td> <input type="text" autocomplete="off" class="form-control datepicker" placeholder="Start Date" id="startdate"> </td>
                        <td> <input type="text" autocomplete="off" class="form-control datepicker" placeholder="End Date" id="enddate"> </td>
                        <td>
                            <select class="form-control" id="priority" required>
                                <option value="">Select Priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </td>
                        <td> <input type="text" class="form-control" placeholder="Remark" id="remark"> </td>
                    </tr>
                </tbody>

                <tbody id="table_space">

                </tbody>

            </table>
            </div>
            
        </div>
    </div>




@endsection

@section('js')
    <script>

        $(document).ready(function() {
            getallData();
        });

        $(".datepicker").datepicker({
            orientation: "bottom"
        });

        function addBacklog()
        {
            var backlog_title = $('#backlog').val();
            var project_id = "{{ $project_id }}";
            var backlog_time = $('#time').val();
            var backlog_state = $('#backlog_state').val();
            var startdate = $('#startdate').val();
            var enddate = $('#enddate').val();
            var priority = $('#priority').val();
            var remark = $('#remark').val();

            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.insert') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_title': backlog_title,
                    'project_id': project_id,
                    'backlog_time': backlog_time,
                    'backlog_state': backlog_state,
                    'startdate': startdate,
                    'enddate': enddate,
                    'priority': priority,
                    'remark': remark,
                },
                success: function (data) {
                    getallData();

                    toastr.options.timeOut = 3000;
                    toastr.options.closeButton = false;
                    toastr.options.progressBar = false;
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.success("Feature Added.", {timeOut: 3000})

                    var backlog_title = $('#backlog').val("");
                    var backlog_time = $('#time').val("");
                    var backlog_state = $('#backlog_state').val("Planned");
                    var startdate = $('#startdate').val("");
                    var enddate = $('#enddate').val("");
                    var priority = $('#priority').val("");
                    var priority = $('#remark').val("");
                }
            });

        }

        function getallData(){
            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.dashboard.getallData') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'edit': false,
                    'project_id': "{{ $project_id }}",
                },
                success: function (data) {
                    $('#table_space').html(data);
                }
            });
        }

        function generateReport(){
            var id = '{{ $project_id }}';
            $.ajax({
                type : 'post' ,
                url : '{{route('backlog.generate.report')}}',
                data : {
                    _token: "{{csrf_token()}}",
                    'project_id': id,
                } ,
                success : function(data){
                    var link = document.createElement("a");
                    link.download = "projects_backlog.xlsx";
                    var uri = '{{url("storage/app")}}'+"/"+"project_backlog.xlsx";
                    link.href = uri;
                    link.click();
                }
            });
        }

    </script>
@endsection

