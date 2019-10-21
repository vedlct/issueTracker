@extends('layouts.mainLayout')

@section('css')
    {{--<style >--}}
    {{--.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{--}}
    {{--padding: 3px;--}}
    {{--}--}}
    {{--</style>--}}
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">Today Work</h4>
            </div>
            <div class="card-body">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Project</th>
                        <th>Feature</th>
                        <th>State</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employeelist as $employee)
                        <tr>
                            <td> {{ $employee->fullName }} </td>
                            <td> {{ $employee->project_name }} </td>
                            <td> {{ $employee->backlog_title }} </td>
                            <td> {{ $employee->backlog_state }} </td>
                            <td> {{ $employee->backlog_start_date }} </td>
                            <td> {{ $employee->backlog_end_date }} </td>
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