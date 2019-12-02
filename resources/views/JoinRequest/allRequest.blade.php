@extends('layouts.mainLayout')

@section('css')
    <style >
        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
            padding: 1px;
        }
    </style>
@endsection

@section('content')

    {{-- Modal 2 --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Request Information</h5>
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
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">All Requests</h4>
                {{--<a href="{{ route('company.create') }}" class="btn btn-success float-right" name="button" style="color: #0a1832">Create Company</a>--}}
                {{--<a href="{{ route('company.export') }}" class="btn btn-secondary float-right mr-2" name="button">Export Companies</a>--}}
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="reqTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Company URL</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Sent Request Time</th>
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

            dataTable=  $('#reqTable').DataTable({
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
                    "url": "{!! route('join.getAllJoinRequest') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns: [
                    { data: 'company_name', name: 'joinRequest.company_name' },
                    { data: 'company_url', name: 'joinRequest.company_url' },
                    { data: 'company_email', name: 'joinRequest.company_email' },
                    { data: 'company_phone', name: 'joinRequest.company_phone' },
                    { data: 'created_at', name: 'joinRequest.created_at' },

                    { "data": function(data){
                            return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.id+'" onclick="showRequest(this)"><i class="fa fa-eye"></i></button>'+
                                   '<button class="btn btn-danger btn-sm mr-2" data-panel-id="'+data.id+'" onclick="deleteRequest(this)"><i class="fa fa-trash"></i></button>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows"
                     },
                ]
            } );

        } );

        function deleteRequest(x) {
            btn = $(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        // delete
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('join.request.delete') !!}",
                            cache: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                'id': btn
                            },
                            success: function (data) {

                                toastr.options.timeOut = 3000;
                                toastr.options.closeButton = false;
                                toastr.options.progressBar = false;
                                toastr.options.positionClass = "toast-bottom-right";
                                toastr.success("Request Deleted.", {timeOut: 4000})

                                dataTable.ajax.reload();
                            }
                        });

                    },
                    cancel: function () {

                    },
                }
            });

            {{--var result = confirm("Are you sure want to delete?");--}}
            {{--if (result) {--}}
                {{--btn = $(x).data('panel-id');--}}
                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: "{!! route('join.request.delete') !!}",--}}
                    {{--cache: false,--}}
                    {{--data: {--}}
                        {{--_token: "{{csrf_token()}}",--}}
                        {{--'id': btn--}}
                    {{--},--}}
                    {{--success: function (data) {--}}

                        {{--toastr.options.timeOut = 3000;--}}
                        {{--toastr.options.closeButton = false;--}}
                        {{--toastr.options.progressBar = false;--}}
                        {{--toastr.options.positionClass = "toast-bottom-right";--}}
                        {{--toastr.success("Request Deleted.", {timeOut: 4000})--}}

                        {{--dataTable.ajax.reload();--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        }

        function showRequest(x) {
            id = $(x).data('panel-id');

            $.ajax({
                type: 'POST',
                url: "{!! route('join.request.show') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'id': id,
                },
                success: function (data) {
                    $('#editModalBody').html(data);
                    $('#editModal').modal('show');
                }
            });
        }

    </script>

@endsection
