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

        {{-- Modal 2 --}}
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Change Admin Information</h5>
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


    <!-- Add Department Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('company.admin.insert') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="myCompany" name="myCompany">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" name="fullname" class="form-control" required placeholder="Fullname">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password1" class="form-control" required placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" required placeholder="example@gmail.com">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password2" class="form-control" required placeholder="Confirm Password">
                                </div>

                                <div class="form-group">
                                    <label for="file1">Select Profile Photo</label>
                                    <input type="file" name="profilePhoto" class="form-control-file" id="file1">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Add Company Admin</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: 300; display: inline;">Admin Management</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Add New Admin</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="deptTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Phone</th>
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
                    "url": "{!! route('company.getAllAdmin') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns:
                    [
                        { data: 'fullName', name: 'user.fullName' },
                        { data: 'email', name: 'user.email' },
                        { data: 'designation', name: 'user.designation' },
                        { data: 'userPhoneNumber', name: 'user.userPhoneNumber' },
                        { "data": function(data)
                            {
                                {{--return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.userId+'" onclick="editAdmin(this)"><i class="fa fa-cog"></i></button>' +--}}
                                       {{--'<button class="btn btn-danger btn-sm" onclick="deleteAdmin({{ $admin->userId }})"> <i class="fa fa-trash" aria-hidden="true"></i> </button>';--}}

                                return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.userId+'" onclick="editAdmin(this)"><i class="fa fa-cog"></i></button>'+
                                       '<button class="btn btn-danger btn-sm" data-panel-id="'+data.userId+'" onclick="deleteAdmin(this)"><i class="fa fa-trash"></i></button>';
                            },
                            "orderable": false, "searchable":false, "name":"selected_rows"
                        },
                    ]
            });
        });

        // CALL EDIT ADMIN
        function editAdmin(x) {
            id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('mycompany.admin.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'admin_user_id': id,
                },
                success: function (data) {
                    $('#editModalBody').html(data);

                    $('#editModal').modal('show');
                }
            });
        }

        function deleteAdmin(x) {
            id = $(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        // DELETE
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('user.delete.admin') }}",
                            cache: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                'id': id
                            },
                            success: function (data) {
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
