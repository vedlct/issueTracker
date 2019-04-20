@extends('layouts.mainLayout')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        {{-- INSERT --}}
        <div class="card">
            {{--<div class="card-header bg-dark text-white custom-2">--}}
                {{--<h4 class="float-left font-weight-normal">Add employee to other company</h4>--}}
            {{--</div>--}}

            <div class="card-header bg-dark text-white custom-2">
                Add employee to other company
            </div>

            <div class="card-body">

                <div class="">
                    <form method="post" action="{{ route('employee.insert') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Select Employee</label>
                                    <select class="form-control" name="empId" required>
                                        <option value="">Employee List</option>
                                        @foreach($emp as $emp)
                                            <option value="{{ $emp->userId }}">{{ $emp->fullName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Select Company</label>
                                    <select class="form-control" id="company" name="companyId" required>
                                        <option value="">Company List</option>
                                        @foreach($companyList as $company)
                                            <option value="{{ $company->companyId }}">{{ $company->companyName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary pull-right">ADD EMPLOYEE</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Employee List --}}
        <div class="card mt-4">
            <div class="card-header bg-dark text-white custom-2">
                Employee Information
            </div>
            <div class="card-body">
                <table id="emptable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    {{--@foreach($adminlist as $admin)--}}
                        {{--<tr>--}}
                            {{--<td> {{ $admin->fullName }} </td>--}}
                            {{--<td> {{ $admin->email }} </td>--}}
                            {{--<td> {{ $admin->userPhoneNumber }} </td>--}}
                            {{--<td> {{ $admin->userType }} </td>--}}

                            {{--<td> {{ $admin->companyName }} </td>--}}
                            {{--<td>--}}
                                {{--@if($admin->status == 1)--}}
                                    {{--Active--}}
                                {{--@else--}}
                                    {{--Inactive--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<button class="btn btn-success btn-sm" onclick="location.href='{{ route('user.edit.admin', ['emp_id'=>$admin->userId]) }}'"> <i class="fa fa-pencil-square" aria-hidden="true"></i> </button>--}}
                                {{--<button class="btn btn-danger btn-sm" onclick="deleteAdmin({{ $admin->userId }})"> <i class="fa fa-trash" aria-hidden="true"></i> </button>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <script>

        $(document).ready(function() {

            dataTable=  $('#emptable').DataTable({
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
                    "url": "{!! route('get.all.EmpInfo') !!}",
                    "type": "POST",
                    data:function (d){
                        d._token="{{csrf_token()}}";
                    },
                },
                columns:
                    [
                        { data: 'fullName', name: 'user.fullName' },
                        { data: 'email', name: 'user.email' },
                        { data: 'userPhoneNumber', name: 'user.userPhoneNumber' },
                        { data: 'companyName', name: 'user.companyName' },



                        { "data": function(data)
                            {
                                return '<button class="btn btn-success btn-sm mr-2 m-1" data-panel-id="'+data.userId+'" onclick="editDept(this)"><i class="fa fa-cog"></i></button>'+
                                    '<button class="btn btn-danger btn-sm" data-panel-id="'+data.userId+'" onclick="deleteDept(this)"><i class="fa fa-trash"></i></button>';
                            },
                            "orderable": false, "searchable":false, "name":"selected_rows"
                        },
                    ]
            });
        });

    </script>

@endsection
