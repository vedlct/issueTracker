@extends('layouts.mainLayout')

@section('css')
    <style >
        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
            padding: 1px;
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
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Change Designation Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="editModalBody">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Designation Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Designation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('mycompany.designation.insert') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" placeholder="Designation Title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary pull-right">Add Designation</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="card top top1">
            <div class="card-header">
                <h4 style="font-weight: 300; display: inline;">Designation Settings</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Add New Department</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="deptTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Designation Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')

    <script>

        $(document).ready(function() {

            dataTable=  $('#deptTable').DataTable({
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
                    "url": "{!! route('company.getAllDesignation') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns:
                    [
                        { data: 'designation_name', name: 'designation.designation_name' },
                        // { data: 'companyName', name: 'company.companyName' },
                        { "data": function(data)
                            {
                                return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.designation_id+'" onclick="editDept(this)"><i class="fa fa-cog"></i></button>'+
                                    '<button class="btn btn-danger btn-sm" data-panel-id="'+data.designation_id+'" onclick="deleteDept(this)"><i class="fa fa-trash"></i></button>';
                            },
                            "orderable": false, "searchable":false, "name":"selected_rows"
                        },
                    ]
            });
        });

        // call edit dept
        function editDept(x) {
            id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('designation.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'designation_id': id,
                },
                success: function (data) {
                    $('#editModalBody').html(data);
                    $('#editModal').modal('show');
                }
            });
        }

        // call delete dept
        function deleteDept(x) {
            btn = $(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        // delete
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('designation.delete') !!}",
                            cache: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                'id': btn
                            },
                            success: function (data) {
                                $.alert({
                                    animationBounce: 2,
                                    title: 'Success!',
                                    content: 'Designation Deleted',
                                });
                                dataTable.ajax.reload();
                            }
                        });

                    },
                    cancel: function () {

                    },
                }
            });

        }


    </script>

@endsection
