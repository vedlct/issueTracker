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
                <h4 class="float-left">Client List</h4>
                <a href="{{ route('add.client') }}" class="btn btn-success float-right" name="button">Add Client</a>
            </div>
            <div class="card-body">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Type</th>
                        <th>Client Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientlist as $client)
                        <tr>
                            <td> {{ $client->fullName }} </td>
                            <td> {{ $client->email }} </td>
                            <td> {{ $client->userPhoneNumber }} </td>
                            <td> {{ $client->userType }} </td>
                            <td>
                                @if($client->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="location.href='{{ route('edit.client.profile', ['client_id'=>$client->userId]) }}'"> <i class="fa fa-cog" aria-hidden="true"></i> </button>
                                {{--<button class="btn btn-danger" data-panel-id="{{ $employee->userId }}" onclick="deleteEmployee(this)"> <i class="fa fa-trash fa-lg" aria-hidden="true"></i> </button>--}}
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
            $('#employeeTable').DataTable();
        } );

        {{--function deleteEmployee(x) {--}}
        {{--// confirmation--}}
        {{--var result = confirm("Are you sure want to delete?");--}}
        {{--if (result) {--}}
        {{--btn = $(x).data('panel-id');--}}
        {{--$.ajax({--}}
        {{--type: 'POST',--}}
        {{--url: "{!! route('employee.delete') !!}",--}}
        {{--cache: false,--}}
        {{--data: {--}}
        {{--_token: "{{csrf_token()}}",--}}
        {{--'id': btn--}}
        {{--},--}}
        {{--});--}}
        {{--}--}}
        {{--}--}}

    </script>
@endsection
