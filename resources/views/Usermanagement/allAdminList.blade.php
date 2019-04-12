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
                <h4 class="float-left">Admin List</h4>
            </div>
            <div class="card-body">
                <table id="adminTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($adminlist as $admin)
                        <tr>
                            <td> {{ $admin->fullName }} </td>
                            <td> {{ $admin->email }} </td>
                            <td> {{ $admin->userPhoneNumber }} </td>
                            <td> {{ $admin->userType }} </td>
                            <td>
                                @if($admin->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="location.href='{{ route('user.edit.admin', ['emp_id'=>$admin->userId]) }}'"> <i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> </button>
                            </td>
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
            $('#adminTable').DataTable();
        } );

    </script>
@endsection