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
                <h4 class="float-left">Employee List</h4>
                <a href="{{ route('user.add.employee') }}" class="btn btn-success float-right" name="button">Add Employee</a>
            </div>
            <div class="card-body">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Type</th>
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
                                <td> ... </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
