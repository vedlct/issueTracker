@extends('layouts.mainLayout')

@section('css')
    {{--<style >--}}
        {{--.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{--}}
            {{--padding: 3px;--}}
        {{--}--}}
    {{--</style>--}}
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
        <div class="card top top1">
            <div class="card-header">
                <h4 class="float-left">Employee List</h4>
                <a href="{{ route('user.add.employee') }}" class="btn btn-success float-right" name="button">Add Employee</a>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                            <th>User Designation</th>
                            <th>Employee Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employeelist as $employee)
                            <tr>
                                <td> {{ $employee->fullName }} </td>
                                <td> {{ $employee->email }} </td>
                                <td> {{ $employee->userPhoneNumber }} </td>
                                <td> {{ $employee->userType }} </td>
                                <td> {{ $employee->designation_name }} </td>
                                <td>
                                    @if($employee->status == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="location.href='{{ route('edit.employee.profile', ['emp_id'=>$employee->userId]) }}'"> <i class="fa fa-pencil-square" aria-hidden="true"></i> </button>
                                    {{--<button class="btn btn-danger" data-panel-id="{{ $employee->userId }}" onclick="deleteEmployee(this)"> <i class="fa fa-trash fa-lg" aria-hidden="true"></i> </button>--}}
                                </td>
                            </tr>
                        @endforeach
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
            $('#employeeTable').DataTable();
        } );

    </script>
@endsection
