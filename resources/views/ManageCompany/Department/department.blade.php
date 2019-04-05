@extends('layouts.mainLayout')
@section('content')


    <!-- Add Department Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('department.add') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Dept Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Information</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="info" id="" placeholder="Dept Info"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary pull-right">Add Department</button>
                            </div>
                        </div>
                    </form>

                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: 300; display: inline;">Department Settings</h4>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Add New Department</button>
                </div>
            </div>
            <div class="card-body">

                {{--<form method="post" action="{{ route('company.update', ['id' => $company->companyId]) }}">--}}
                    {{--{{csrf_field()}}--}}
                    {{--<div class="row">--}}
                        {{--<input type="hidden" name="id" value="{{ $company->companyId }}">--}}
                        {{--<div class="form-group col-md-6">--}}
                            {{--<label>Company Name</label>--}}
                            {{--<input type="text" class="form-control" placeholder="Company Name" value="{{ $company->companyName }}" name="companyName" required>--}}
                        {{--</div>--}}

                        {{--<div class="form-group col-md-6">--}}
                            {{--<label>Company Email</label>--}}
                            {{--<input type="email" class="form-control" placeholder="Email" value="{{ $company->companyEmail }}" name="companyEmail" required>--}}
                        {{--</div>--}}

                        {{--<div class="form-group col-md-6">--}}
                            {{--<label>Phone 1</label>--}}
                            {{--<input type="tel" class="form-control" placeholder="Phone 1" value="{{ $company->companyPhone1 }}" name="companyPhone1">--}}
                        {{--</div>--}}

                        {{--@if($company->companyPhone2)--}}
                            {{--<div class="form-group col-md-6">--}}
                                {{--<label>Phone 2</label>--}}
                                {{--<input type="text" class="form-control" placeholder="Phone 2" value="{{ $company->companyPhone2 }}" name="companyPhone2">--}}
                            {{--</div>--}}
                        {{--@else--}}
                            {{--<div class="form-group col-md-6">--}}
                                {{--<label>Phone 2</label>--}}
                                {{--<input type="text" class="form-control" placeholder="Phone 2" value="" name="companyPhone2">--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        {{--<div class="form-group col-md-12">--}}
                            {{--<label>Company Info</label>--}}
                            {{--<textarea  class="form-control" placeholder="Company Info" name="info">{{ $company->companyInfo }}</textarea>--}}
                        {{--</div>--}}

                        {{--<div class="form-group col-md-12">--}}
                            {{--<label>Address</label>--}}
                            {{--<textarea  class="form-control" placeholder="Company Address" name="address">{{ $company->companyAddress }}</textarea>--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-12">--}}
                            {{--<button class="btn btn-success">Update Company</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}

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
                            return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.companyId+'" onclick="editCompany(this)"><i class="fa fa-edit fa-lg"></i></button>'+
                                '<button class="btn btn-danger btn-sm" data-panel-id="'+data.companyId+'" onclick="deleteCompany(this)"><i class="fa fa-trash fa-lg"></i></button>'
                                ;},
                        "orderable": false, "searchable":false, "name":"selected_rows" },
                ]
            } );

        } );

        {{--// call edit company--}}
        {{--function editCompany(x) {--}}
            {{--btn = $(x).data('panel-id');--}}
            {{--var url = '{{ route("company.edit", ":id") }}';--}}
            {{--var newUrl=url.replace(':id', btn);--}}
            {{--window.location.href = newUrl;--}}
        {{--}--}}

        {{--// call delete shop--}}
        {{--function deleteCompany(x) {--}}
            {{--// confirmation--}}
            {{--var result = confirm("Are you sure want to delete?");--}}
            {{--if (result) {--}}
                {{--btn = $(x).data('panel-id');--}}
                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: "{!! route('company.delete') !!}",--}}
                    {{--cache: false,--}}
                    {{--data: {--}}
                        {{--_token: "{{csrf_token()}}",--}}
                        {{--'id': btn--}}
                    {{--},--}}
                    {{--success: function (data) {--}}
                        {{--$.alert({--}}
                            {{--animationBounce: 2,--}}
                            {{--title: 'Success!',--}}
                            {{--content: 'Company Deleted',--}}
                        {{--});--}}
                        {{--dataTable.ajax.reload();--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        }

    </script>

@endsection
