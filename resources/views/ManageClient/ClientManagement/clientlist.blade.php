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
        @media only screen and (max-width: 490px){
            .top{
                margin-top: 5%;
            }
            .left{
                margin-left: -4%;
            }
            .right{
                margin-left: 5%;
            }

        }

        @media only screen and (min-width: 490px) and (max-width: 518px){

            .left1{
                margin-right: 4%;
            }


        }
        @media only screen and (min-width: 519px) and (max-width: 518px) {

            .right1{
                margin-left: -20%;
            }


        }
        @media only screen and (min-width: 830px) and (max-width: 838px) {

            .rotate{
              margin-left: -5%;
            }


        }
    </style>

    <style>
        @media only screen and (min-width: 338px) and (max-width: 379px){
            .top1{
                margin-top: 20%;
            }

        }
        @media only screen and (max-width: 337px){
            .top2{
                margin-top: 60%;
            }

        }
    </style>

    <!-- Add Sub Company Modal -->
    <div class="modal fade" id="addSubCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD NEW CLIENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('client.insert') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Client Name *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Client name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Client Official Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" placeholder="mail@gmail.com">
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-sm-3 col-form-label">Password</label>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <input type="password" class="form-control" name="password" placeholder="password">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Client Information</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="info" placeholder="Client information"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary pull-right">Add Client</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Edit Client --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">CHANGE CLIENT INFORMATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editModalBody">

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card top1 top2">
            <div class="card-header">
                <h4 class="float-left">Client List</h4>
                <button type="button" class="btn btn-success float-right" name="button" style="color: #0a1832" data-toggle="modal" data-target="#addSubCompanyModal">Create Client</button>
                {{--<a href="{{ route('company.export') }}" class="btn btn-secondary float-right mr-2" name="button">Export Companies</a>--}}
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="clientTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Information</th>
                            <th>Created at</th>
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

            dataTable=  $('#clientTable').DataTable({
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
                    "url": "{!! route('client.getAllClient') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns:
                    [
                        { data: 'clientName', name: 'client.clientName' },
                        { data: 'clientEmail', name: 'client.clientEmail' },
                        { data: 'clientInfo', name: 'client.clientInfo' },
                        { data: 'created_at', name: 'client.created_at' },

                        {
                            "data": function(data){
                                return '<button class="btn btn-success btn-sm mr-2 m-1 left1" data-panel-id="'+data.clientId+'" onclick="editClient(this)"><i class="fa fa-cog"></i></button>'+
                                       '<button class="btn btn-danger btn-sm mr-2 right" data-panel-id="'+data.clientId+'" onclick="deleteClient(this)"><i class="fa fa-trash"></i></button>'+
                                       '<button class="btn btn-primary btn-sm top left right1 rotate" data-panel-id="'+data.clientId+'" onclick="showContactPerson(this)"><i class="fa fa-users" style="width: 12px;"></i></button>'
                                    ;},
                            "orderable": false, "searchable":false, "name":"selected_rows"
                        },
                    ]
            } );

        } );

        // CALL EDIT MODAL
        function editClient(x) {
            id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('client.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'clientId': id,
                },
                success: function (data) {
                    $('#editModalBody').html(data);
                    $('#editModal').modal('show');
                }
            });
        }

        // CALL DELETE COMPANY
        function deleteClient(x) {
            btn = $(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        // delete
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('client.delete') !!}",
                            cache: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                'clientId': btn
                            },
                            success: function (data) {
                                $.alert({
                                    animationBounce: 2,
                                    title: 'Success!',
                                    content: 'Client Deleted',
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

        // SHOW CONTACT PERSON LIST
        function showContactPerson(x) {
            btn = $(x).data('panel-id');
            var url = '{{ route("client.show.contactPerson", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

    </script>

@endsection
