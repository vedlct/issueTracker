@extends('layouts.mainLayout')

@section('css')
    <style >
        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
            padding: 1px;
        }
        .progress{
             height: 1.5rem !important;
        }
    </style>
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
            <h5 class="float-left">Projects Information</h5>
            @if(Auth::user()->fk_userTypeId == 1 || Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 3 || Auth::user()->fk_userTypeId == 5)
                <a href="{{ route('project.create') }}" class="btn btn-success btn-sm float-right mt-1" style="color: #0a1832" name="button">Create Project</a>
            @endif
        </div>
        <div class="card-body">
            <div class="table table-responsive">
            <table id="projectTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Category</th>
                        <th>Project Type</th>
                        <th>Project Created By</th>
                        {{--<th>Project Owner</th>--}}
                        <th>Client</th>
                        <th>Completion Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>


            {{-- Project for Issue --}}
            {{--<h2 class="mb-3 mt-3">Project for Issue</h2>--}}
            {{--<table id="projectTable2" class="table-bordered table-condensed text-center table-hover" style="width:100%">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>Project Name</th>--}}
                    {{--<th>Project Type</th>--}}
                    {{--<th>Project Status</th>--}}
                    {{--<th>Project Created By</th>--}}
                    {{--<th>Client</th>--}}
                    {{--<th>Completion Status</th>--}}
                    {{--<th>Action</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--</tbody>--}}
            {{--</table>--}}
        </div>
    </div>

    {{-- Project for issue --}}
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="float-left">Projects for Issue</h5>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
            <table id="projectTable2" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Category</th>
                    <th>Project Type</th>
                    <th>Project Created By</th>
                    <th>Client</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="float-left">Proposed projects</h5>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
            <table id="proposedProject" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th>Duration</th>
                    <th>Created By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="Pproject" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="project_title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div>
                    <ul id="features">
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')

<script>

        $(document).ready(function() {

            var project_percentage = <?php echo json_encode($project_percentage); ?>

            dataTable=  $('#projectTable').DataTable({
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
                   "url": "{!! route('project.getAllProject') !!}",
                   "type": "POST",
                   data:function (d){
                       d._token="{{csrf_token()}}";
                   },
               },
               columns: [
                   { data: 'project_name', name: 'project.project_name' },
                   { data: 'project_type', name: 'project.project_type' },
                   { data: 'statusData', name: 'status.statusData' },
                   { data: 'fullName', name: 'user.fullName' },
                   { data: 'clientName', name: 'client.clientName' },
                   {
                       "data": function(data)
                       {
                           for(var project_id in project_percentage)
                           {
                               if(data.projectId == project_id)
                               {
                                   return '<div class="progress ml-2 mr-2"> <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'+project_percentage[project_id]+'" aria-valuemin="0" aria-valuemax="100" style="width: '+project_percentage[project_id]+'% "> <span style="color:#0a1832; margin-left: 10px;"> '+project_percentage[project_id]+' % </span>  </div> </div>';
                               }
                           }
                       }
                   },
                   { "data": function(data)
                       {
                            return '<button class="btn btn-success btn-sm m-1" data-panel-id="'+data.projectId+'" onclick="editProject(this)"><i class="fa fa-pencil-square"></i></button>';
                               //  '<button class="btn btn-danger btn" data-panel-id="'+data.projectId+'" onclick="deleteProject(this)"><i class="fa fa-trash fa-lg"></i></button>'
                       },
                       "orderable": false, "searchable":false, "name":"selected_rows"
                   },
               ]
            } );

            // project for issue
            dataTable=  $('#projectTable2').DataTable({
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
                    "url": "{!! route('project.getAllProject2') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns: [
                    { data: 'project_name', name: 'project.project_name' },
                    { data: 'project_type', name: 'project.project_type' },
                    { data: 'statusData', name: 'status.statusData' },
                    { data: 'fullName', name: 'user.fullName' },
                    { data: 'clientName', name: 'client.clientName' },
                    { "data": function(data)
                        {
                            return '<button class="btn btn-success btn-sm m-1" data-panel-id="'+data.projectId+'" onclick="editProject(this)"><i class="fa fa-pencil-square"></i></button>';
                            //  '<button class="btn btn-danger btn" data-panel-id="'+data.projectId+'" onclick="deleteProject(this)"><i class="fa fa-trash fa-lg"></i></button>'
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    }
                ]
            });

            proposedProject=  $('#proposedProject').DataTable({
                // "searching": false,
                // "lengthChange": false,
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
                    "url": "{!! route('project.getProposedProject') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns: [
                    { data: 'project_name', name: 'project.project_name' },
                    { data: 'clientName', name: 'client.clientName' },
                    { data: 'project_duration', name: 'project.project_duration' },
                    { data: 'fullName', name: 'user.fullName' },
                    { data: 'project_created_at', name: 'project.project_created_at' },
                    { "data": function(data)
                        {
                            return '<button class="btn btn-info btn-sm m-1" data-panel-id="'+data.projectId+'" onclick="backLogView(this)"><i class="fa fa-eye"></i></button>' +
                                '<button class="btn btn-success btn-sm m-1" data-panel-id="'+data.projectId+'" onclick="editProject(this)"><i class="fa fa-pencil-square"></i></button>';
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    }
                ]
            });

        } );

        {{--function prProject(x) {--}}

        {{--    $.ajax({--}}
        {{--         type: 'POST',--}}
        {{--         url: "{!! route('proposed.project.feature') !!}",--}}
        {{--         cache: false,--}}
        {{--         data: {--}}
        {{--             _token: "{{csrf_token()}}",--}}
        {{--             'projectId': $(x).data('panel-id')--}}
        {{--         },--}}
        {{--         success: function (data) {--}}

        {{--             $('#project_title').html($(x).data('panel-project_name'));--}}
        {{--             $.each(data, function(i){--}}
        {{--                 $('#features').append("<li>" + i + "</li>");--}}
        {{--             });--}}
        {{--             $('#Pproject').modal('show');--}}
        {{--         }--}}
        {{--    });--}}
        {{--}--}}
        // call edit project
        function editProject(x) {
            btn = $(x).data('panel-id');
            var url = '{{ route("project.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        function backLogView(x) {
            btn = $(x).data('panel-id');
            var url = '{{ route("project.features", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

    </script>

@endsection
