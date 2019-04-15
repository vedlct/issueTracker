@extends('layouts.mainLayout')


@section('css')
    <style>
        tr{
            text-align: center;
        }
        .table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td {
            padding: 5px 12px !important;
        }

    </style>
@endsection


@section('content')

    <!-- EDIT Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Feature Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit_modal_space">

                </div>
            </div>
        </div>
    </div>



    <div class="card">
        <h5 class="card-header mt-0">
            {{ $project->project_name }}
            <a class="btn btn-primary btn-sm pull-right ml-2" href="{{ route('project.Information', $project->projectId) }}">ADD FEATURE</a>
            <a class="btn btn-primary btn-sm pull-right ml-2" href="{{ route('project.projectmanagement', $project->projectId) }}">ADD FEATURE (ADVANCE)</a>
            <a class="btn btn-sm btn-secondary pull-right" style="color: white" onclick="generateReport()">Generate Project Excel</a>
        </h5>

        <div class="card-body">


            <table class="table table-bordered table-sm table-condensed" id="featurelist">
                <thead>
                    <tr>
                        {{--<th style="text-align: center" scope="col">#</th>--}}
                        <th scope="col">Name</th>
                        <th scope="col">Total Hour</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Priority</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>

                {{--<tbody id="table_space"></tbody>--}}

                <tbody></tbody>

                <tr>
                    <td><b>Total Expected Hour</b></td>
                    <td>{{ $exp_time }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>

        </div>
    </div>




@endsection

@section('js')
    <script>

        $(document).ready(function() {
            // getallData();
        });

        $(document).ready(function() {

            dataTable=  $('#featurelist').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(0)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Filter: true,
                stateSave: true,
                ordering:false,
                type:"POST",
                "ajax":{
                    "url": "{!! route('features.all') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token = "{{csrf_token()}}";
                        d.project_id = "{{ $project->projectId }}";
                    },
                },
                columns: [

                    { data: 'backlog_title', name: 'backlog.backlog_title' },
                    { data: 'backlog_time', name: 'backlog.backlog_time' },
                    { data: 'backlog_state', name: 'backlog.backlog_state' },
                    { data: 'backlog_start_date', name: 'backlog.backlog_start_date' },
                    { data: 'backlog_end_date', name: 'backlog.backlog_end_date' },
                    { data: 'backlog_priority', name: 'backlog.backlog_priority' },
                    { "data": function(data) {

                            return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.backlog_id + '" onclick="editFeature(this)"><i class="fa fa-pencil-square"></i></button>' +
                                   '<button class="btn btn-danger btn-xs m-1" data-panel-id="' + data.backlog_id + '" onclick="deleteFeature(this)"><i class="fa fa-trash-o"></i></button>';
                        },

                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                ]
            } );
        } );



        {{--function getallData(){--}}
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: "{!! route('backlog.dashboard.getallData') !!}",--}}
                {{--cache: false,--}}
                {{--data: {--}}
                    {{--_token: "{{csrf_token()}}",--}}
                    {{--'project_id': "{{ $project->projectId }}",--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--$('#table_space').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

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

        function editFeature(x) {
            id = $(x).data('panel-id');
            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.dashboard.getEditModal') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': id,
                },
                success: function (data) {
                    $('#edit_modal_space').html(data);
                    $('#EditModal').modal('show')
                }
            });
        }

        function deleteFeature(x) {

            id = $(x).data('panel-id');

            $.confirm({
                title: 'Delete Confirmation!',
                content: 'Are you sure want to delete ?',
                buttons: {
                    confirm: function () {

                        $.ajax({
                            type: 'POST',
                            url: "{!! route('backlog.dashboard.delete') !!}",
                            cache: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                'backlog_id': id,
                            },
                            success: function (data) {

                                dataTable.ajax.reload();

                                $.alert('Feature deleted!');

                            }
                        });

                    },
                    cancel: function () {

                    }
                }
            });



        }

    </script>
@endsection

