@extends('layouts.mainLayout')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Team Assignment</h4>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="freeEmployee" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th> <input type="checkbox" id="selectall" onClick="selectAll(this)" /> </th>
                        <th>User ID</th>
                        <th>FullName</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($allEmployee as $employee)
                            <tr>
                                <td> <input type='checkbox' class="checkboxvar" name="checkboxvar[]" value="{{$employee->userId}}"> </td>
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
            </div>
            {{-- Select Team --}}
            <div class="row">
                <div class="form-group col-md-4 ml-3">
                    <label>Select Team</label>
                    <select class="form-control" required name="assignTo" id="otherCatches">
                        <option value=""> Select Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->teamId }}">{{ $team->teamName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

        $(document).ready(function() {
            $('#freeEmployee').DataTable({
                "ordering": false
            });
        } );

        // Select All Checkbox
        function selectAll(source) {
            checkboxes = document.getElementsByName('checkboxvar[]');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }

        // assign team
        $("#otherCatches").change(function() {
            var chkArray = [];
            var teamId=$(this).val();



            $('.checkboxvar:checked').each(function (i) {
                chkArray[i] = $(this).val();
            });

            // console.log(chkArray);

            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            jQuery('input:checkbox:checked').parents("tr").remove();
            $(this).prop('selectedIndex',0);

            $.ajax({
                type : 'post' ,
                url : '{{route('team.employee.insert')}}',
                data : {
                    _token: "{{csrf_token()}}",
                    'userId':chkArray,
                    'teamId':teamId
                } ,
                success : function(data){
                    if(data == 'true'){

                        alert('Successfully Employee Assigned');

                        location.reload();
                        $('#freeEmployee').load(document.URL +  ' #freeEmployee');


                        $('#alert').html(' <strong>Success!</strong> Assigned');
                        $('#alert').show();

                    }
                }
            });
        });




    </script>
@endsection