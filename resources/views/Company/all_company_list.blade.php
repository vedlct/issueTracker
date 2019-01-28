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
            <h4 class="float-left">Company Information</h4>
            <a href="{{ route('company.create') }}" class="btn btn-success float-right" name="button">Create Company</a>
            <a href="{{ route('company.export') }}" class="btn btn-secondary float-right mr-2" name="button">Export Companies</a>
        </div>
        <div class="card-body">
            <table id="companyTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Company Information</th>
                        <th>Email</th>
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

@endsection

@section('js')

<script>

        $(document).ready(function() {

            dataTable=  $('#companyTable').DataTable({
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
                   "url": "{!! route('company.getAllCompany') !!}",
                   "type": "POST",
                   data:function (d){
                       d._token="{{csrf_token()}}";
                   },
               },
               columns: [
                   { data: 'companyName', name: 'company.companyName' },
                   { data: 'companyInfo', name: 'company.companyInfo' },
                   { data: 'companyEmail', name: 'company.companyEmail' },
                   { data: 'companyPhone1', name: 'company.companyPhone1' },

                   { "data": function(data){
                            return '<button class="btn btn-success btn mr-2" data-panel-id="'+data.companyId+'" onclick="editCompany(this)"><i class="fa fa-edit fa-lg"></i></button>'+
                                   '<button class="btn btn-danger btn" data-panel-id="'+data.companyId+'" onclick="deleteCompany(this)"><i class="fa fa-trash fa-lg"></i></button>'
                            ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
               ]
            } );

        } );

        // call edit company
        function editCompany(x) {
            btn = $(x).data('panel-id');
            var url = '{{ route("company.edit", ":id") }}';
            var newUrl=url.replace(':id', btn);
            window.location.href = newUrl;
        }

        // call delete shop
        function deleteCompany(x) {
            // confirmation
            var result = confirm("Are you sure want to delete?");
            if (result) {
                btn = $(x).data('panel-id');
                $.ajax({
                     type: 'POST',
                     url: "{!! route('company.delete') !!}",
                     cache: false,
                     data: {
                         _token: "{{csrf_token()}}",
                         'id': btn
                     },
                     success: function (data) {
                         $.alert({
                             animationBounce: 2,
                             title: 'Success!',
                             content: 'Company Deleted',
                         });
                         dataTable.ajax.reload();
                     }
                });
            }
        }

    </script>

@endsection
