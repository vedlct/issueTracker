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

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="float-left">Projects Information</h5>
            @if(Auth::user()->fk_userTypeId == 1 || Auth::user()->fk_userTypeId == 4 || Auth::user()->fk_userTypeId == 3)
                <a href="{{ route('project.create') }}" class="btn btn-success btn-sm float-right mt-1" style="color: #0a1832" name="button">Create Project</a>
            @endif
        </div>
        <div class="card-body">
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
            <table id="projectTable2" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Category</th>
                    <th>Project Type</th>
                    <th>Project Created By</th>
                    <th>Client</th>
                    {{--<th>Completion Status</th>--}}
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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

                   // {
                   //     "data": function(data)
                   //     {
                   //         if(data.companyName == null)
                   //         {
                   //             return "";
                   //         }
                   //         else
                   //         {
                   //             return data.companyName;
                   //         }
                   //     },
                   // },

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

                    // {
                    //     "data": function(data)
                    //     {
                    //         if(data.companyName == null)
                    //         {
                    //             return "";
                    //         }
                    //         else
                    //         {
                    //             return data.companyName;
                    //         }
                    //     },
                    // },

                    // {
                    //     "data": function(data)
                    //     {
                    //         for(var project_id in project_percentage)
                    //         {
                    //             if(data.projectId == project_id)
                    //             {
                    //                 return '<div class="progress ml-2 mr-2"> <div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'+project_percentage[project_id]+'" aria-valuemin="0" aria-valuemax="100" style="width: '+project_percentage[project_id]+'% "> <span style="color:#0a1832; margin-left: 10px;"> '+project_percentage[project_id]+' % </span>  </div> </div>';
                    //             }
                    //         }
                    //     }
                    // },

                    { "data": function(data)
                        {
                            return '<button class="btn btn-success btn-sm m-1" data-panel-id="'+data.projectId+'" onclick="editProject(this)"><i class="fa fa-pencil-square"></i></button>';
                            //  '<button class="btn btn-danger btn" data-panel-id="'+data.projectId+'" onclick="deleteProject(this)"><i class="fa fa-trash fa-lg"></i></button>'
                        },
                        "orderable": false, "searchable":false, "name":"selected_rows"
                    },
                ]
            } );

        } );

        // call edit project
        function editProject(x) {
            btn = $(x).data('panel-id');
            var url = '{{ route("project.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        // call delete project
        // function deleteProject(x) {
        //     // confirmation
        //     var result = confirm("Are you sure want to delete?");
        //     if (result) {
        //         btn = $(x).data('panel-id');
        //         $.ajax({
        //              type: 'POST',
        //              url: "{!! route('company.delete') !!}",
        //              cache: false,
        //              data: {
        //                  _token: "{{csrf_token()}}",
        //                  'id': btn
        //              },
        //              success: function (data) {
        //                  $.alert({
        //                      animationBounce: 2,
        //                      title: 'Success!',
        //                      content: 'Company Deleted',
        //                  });
        //                  dataTable.ajax.reload();
        //              }
        //         });
        //     }
        // }


    </script>

@endsection
