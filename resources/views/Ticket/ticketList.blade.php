@extends('layouts.mainLayout')

@section('css')
<style >
.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
    padding: 1px;
}
</style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left">Tickets</h4>
            <a href="{{ route('ticket.create') }}" class="btn btn-success float-right" name="button">Create Ticket</a>
        </div>
        <div class="card-body">
            <table id="projectTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Ticket Topic</th>
                        <th>Ticket Status</th>
                        <th>Ticket Open Date</th>
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

            // dataTable=  $('#projectTable').DataTable({
            //    rowReorder: {
            //        selector: 'td:nth-child(0)'
            //    },
            //    responsive: true,
            //    processing: true,
            //    serverSide: true,
            //    Filter: true,
            //    stateSave: true,
            //    ordering:false,
            //    type:"POST",
            //    "ajax":{
            //        "url": "{!! route('project.getAllProject') !!}",
            //        "type": "POST",
            //        data:function (d){
            //            d._token="{{csrf_token()}}";
            //        },
            //    },
            //    columns: [
            //        { data: 'projectName', name: 'project.projectName' },
            //        { data: 'statusData', name: 'status.statusData' },
            //        { data: 'fullName', name: 'user.fullName' },
            //        { data: 'companyName', name: 'company.companyName' },
            //
            //        { "data": function(data){
            //                 return '<button class="btn btn-success btn mr-2" data-panel-id="'+data.projectId+'" onclick="editProject(this)"><i class="fa fa-edit fa-lg"></i></button>'
            //                        // '<button class="btn btn-danger btn" data-panel-id="'+data.projectId+'" onclick="deleteProject(this)"><i class="fa fa-trash fa-lg"></i></button>'
            //                 ;},
            //             "orderable": false, "searchable":false, "name":"selected_rows"
            //         },
            //    ]
            // } );

        } );

        // // call edit project
        // function editProject(x) {
        //     btn = $(x).data('panel-id');
        //     var url = '{{ route("project.edit", ":id") }}';
        //     var newUrl=url.replace(':id', btn);
        //     window.location.href = newUrl;
        // }




    </script>

@endsection
