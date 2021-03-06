@extends('layouts.mainLayout')

@section('css')
    <style>
        tr{
            text-align: center;
        }
        .table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td {
            padding: 5px 12px !important;
        }
        .changeMouse {
            cursor: pointer;
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
    </style>
    <style>
        @media only screen and (min-width: 338px) and (max-width: 379px){
            .top4{
                margin-top: 20%;
            }

        }
        @media only screen and (max-width: 337px){
            .top5{
                margin-top: 60%;
            }

        }
    </style>

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

    <!-- Show Comment Modal -->
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="allComments">

                </div>
            </div>
        </div>
    </div>

    <!-- Show Owner Modal -->
    <div class="modal fade" id="ownerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Owner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="allOwners">

                </div>
            </div>
        </div>
    </div>

    <div class="card top4 top5">
        <h5 class="card-header mt-0">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    {{ $project->project_name }}
                </div>
                @if(Auth::user()->fk_userTypeId != 2)
                <div class="col-md-9 col-sm-9">
                    <a class="btn btn-primary btn-sm pull-right ml-2" href="{{ route('project.Information', $project->projectId) }}">ADD FEATURE</a>
                    <a class="btn btn-primary btn-sm pull-right ml-2 top" href="{{ route('project.projectmanagement', $project->projectId) }}">ADD FEATURE (ADVANCE)</a>
                    <a class="btn btn-sm btn-secondary pull-right top top1 top2 top3" style="color: white" onclick="generateReport()">Generate Project Excel</a>
                </div>
                @endif
            </div>
        </h5>

        <div class="card-body">

            <div class="table table-responsive">
                <table class="table table-bordered table-sm table-condensed" id="featurelist">
                    <tr>
                        <td><b>Total Expected Hour</b></td>
                        <td>{{ $exp_time }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @if(Auth::user()->fk_userTypeId != 2)
                        <td></td>
                        @endif
                    </tr>
                </table>
            <div>
        </div>
    </div>
</div>
</div   >

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            dataTable=  $('#featurelist').DataTable({
//                rowReorder: {
//                    selector: 'td:nth-child(0)'
//                },
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
                    { title: 'Feature', data: 'backlog_title', name: 'backlog.backlog_title' },
                    { title: 'Total Hour', data: 'backlog_time', name: 'backlog.backlog_time' },
                    { title: 'Status', data: 'backlog_state', name: 'backlog.backlog_state' },
                    { title: 'Start Date', data: 'backlog_start_date', name: 'backlog.backlog_start_date' },
                    { title: 'End Date', data: 'backlog_end_date', name: 'backlog.backlog_end_date' },
                    { title: 'Priority', data: 'backlog_priority', name: 'backlog.backlog_priority' },
                    { title: 'Remarks', data: 'remark', name: 'backlog.remark' },
                    { title: 'Comments', "data": function(data)
                        {
                           if(data.comment != null )
                           {
                               return '<a class="changeMouse" onclick="showComments('+data.backlog_id+')"><i class="fa fa-comments"></i></a>';
                           }else{
                               return 'N/A';
                           }
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                    { title: 'Owner', "data": function(data)
                        {
                           return '<a style="text-decoration: underline;" class="changeMouse" onclick="showOwners('+data.backlog_id+')">Show Owner</a>';
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                    @if(Auth::user()->fk_userTypeId != 2)
                    { title: 'Action', "data": function(data)
                        {
                            return '<button class="btn btn-success btn-xs m-1" data-panel-id="' + data.backlog_id + '" onclick="editFeature(this)"><i class="fa fa-pencil-square"></i></button>' +
                                '<button class="btn btn-danger btn-xs m-1" data-panel-id="' + data.backlog_id + '" onclick="deleteFeature(this)"><i class="fa fa-trash-o"></i></button>';
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                    @endif
                ]
            });
        } );
        function showComments(x){
            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.show.getAllMyComments') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': x,
                },
                success: function (data) {
                    $('#allComments').html(data);
                    $('#commentModal').modal('show')
                }
            });
        }
        function showOwners(x){
            $.ajax({
                type: 'POST',
                url: "{!! route('backlog.show.owners') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'backlog_id': x,
                },
                success: function (data) {
                    $('#allOwners').html(data);
                    $('#ownerModal').modal('show')
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
