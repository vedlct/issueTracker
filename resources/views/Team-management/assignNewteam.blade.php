@extends('layouts.mainLayout')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Team Assignment</h4>
            </div>
            <div class="card-body">
                <table id="freeEmployee" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Phone</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($allEmployee as $employee)
                            <tr>
                                <td> {{ $employee->userId }} </td>
                                <td> {{ $employee->fullName }} </td>
                                <td> {{ $employee->email }} </td>
                                <td> {{ $employee->userPhoneNumber }} </td>
                                {{--<td>--}}
                                    {{--<a href="{{ route('edit.employee.profile', ['emp_id'=>$employee->userId]) }}"> <i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> </a>--}}
                                    {{--<a href="{{ route('delete.employee.profile', ['emp_id'=>$employee->userId]) }}"> <i class="fa fa-trash fa-lg" aria-hidden="true"></i> </a>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Select Team --}}
            <form method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-md-4 ml-3">
                        <label>Select Team</label>
                        <select class="form-control" name="companyId" required>
                            @foreach($teams as $team)
                                <option value="{{ $team->teamId }}">{{ $team->teamName }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success mt-2">Assign Team</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('js')
    <script>

        $(document).ready(function() {
            $('#freeEmployee').DataTable();
        } );

    </script>
@endsection