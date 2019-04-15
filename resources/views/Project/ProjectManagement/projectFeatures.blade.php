@extends('layouts.mainLayout')


@section('css')

@endsection


@section('content')


    <div class="card">
        <h5 class="card-header">
            {{ $project->project_name }}
            <a class="btn btn-primary btn-sm pull-right ml-2" href="{{ route('project.Information', $project->projectId) }}">ADD FEATURE</a>
            <a class="btn btn-primary btn-sm pull-right ml-2" href="{{ route('project.projectmanagement', $project->projectId) }}">ADD FEATURE (DETAILED)</a>
            <a class="btn btn-sm btn-secondary pull-right" style="color: white" onclick="generateReport()">Generate Project Excel</a>
        </h5>

        <div class="card-body">


            <table class="table table-bordered table-sm table-condensed">
                <thead>
                <tr>
                    <th style="text-align: center" scope="col">#</th>
                    <th scope="col">Feature Name *</th>
                    <th scope="col">Expected Time</th>
                    <th scope="col">Feature State</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Priority</th>
                </tr>
                </thead>

                <tbody id="table_space"></tbody>
            </table>

        </div>
    </div>




@endsection

@section('js')
    <script>

        $(document).ready(function() {
            getallData();
        });

        {{--$(".datepicker").datepicker({--}}
            {{--orientation: "bottom"--}}
        {{--});--}}

        function getallData(){
            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.dashboard.getallData') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'project_id': "{{ $project->projectId }}",
                },
                success: function (data) {
                    $('#table_space').html(data);
                }
            });
        }

        function generateReport(){
            var id = '{{ $project->projectId }}';
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

