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
                <h4 class="float-left">Team Members</h4>
                {{--<a href="{{ route('company.create') }}" class="btn btn-success float-right" name="button">Create Company</a>--}}
            </div>
            <div class="card-body">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        {{--<th>Employee ID</th>--}}
                        <th>Employee Name</th>
                        <th>Team Name</th>
                        <th>Team ID</th>
                        {{--<th>Company Name</th>--}}
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

            dataTable=  $('#employeeTable').DataTable({
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
                    "url": "{!! route('getAllTeamMembers') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns: [
                    // { data: 'fk_userId', name: 'assignteam_new.fk_userId' },
                    { data: 'fullName', name: 'user.fullName' },
                    { data: 'teamName', name: 'team.teamName' },
                    { data: 'teamId', name: 'team.teamId' },
                    // { data: 'companyPhone1', name: 'company.companyPhone1' },

                    { "data": function(data){
                            return '<button class="btn btn-info btn mr-2" data-panel-id="'+data.id+'" onclick="removeEmployee(this)"><i class="fa fa-trash fa-lg"></i></button>'
                                // '<button class="btn btn-danger btn" data-panel-id="'+data.assignteam_new+'" onclick="deleteCompany(this)"><i class="fa fa-trash fa-lg"></i></button>'
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

        // call delete employee
        function removeEmployee(x) {
            // confirmation
            var result = confirm("Are you sure want to remove?");
            if (result) {
                btn = $(x).data('panel-id');
                $.ajax({
                    type: 'POST',
                    url: "{!! route('remove.employee') !!}",
                    cache: false,
                    data: {
                        _token: "{{csrf_token()}}",
                        'id': btn
                    },
                    success: function (data) {
                        $.alert({
                            animationBounce: 2,
                            title: 'Success!',
                            content: 'Employee Removed',
                        });
                        dataTable.ajax.reload();
                    }
                });
            }
        }

    </script>

@endsection
