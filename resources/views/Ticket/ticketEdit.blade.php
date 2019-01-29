@extends('layouts.mainLayout')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        {{-- Ticket Basic Information --}}
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Edit Ticket</h4>
            </div>

            <div class="card-body">
                <div class="">
                    <form method="post" action="{{ route('ticket.main.update') }}">
                        @csrf
                        <input type="hidden" name="ticketId" id="modalTicketId" value="">

                        <div class="form-group">
                            <label for="teamname">Worked Hour</label>
                            <input type="text" name="workedHour" id="modalWorkedHour" value="" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="ticketStatus">Ticket Status</label>
                            <select class="form-control" id="ticketStatus" name="ticketStatus" required onchange="setRequiredOnClose(this)">
                                <option value="">Select Status</option>
                                <option value="Open" @if($ticket->ticketStatus == 'Open') selected @endif>Open</option>
                                <option value="Close" @if($ticket->ticketStatus == 'Close') selected @endif>Close</option>
                                <option value="Pending" @if($ticket->ticketStatus == 'Pending') selected @endif>Pending</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="company">Assign Type</label>
                            <select class="form-control" id="assignType" name="assignType" onchange="changeType(this)">
                                <option value="">Select Type</option>
                                <option value="single">Assign Single Person</option>
                                <option value="team">Assign Team</option>
                            </select>
                        </div>

                        <div class="form-group" id="assignTypeSingle">
                            <label for="company">Select Employee</label>
                            <select class="form-control" id="assignPerson" name="assignPersonId">
                                <option value="">Select Any Employee</option>
                                @foreach($employeeList as $employee)
                                    <option value="{{ $employee->userId }}">{{ $employee->fullName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="assignTypeTeam">
                            <label for="company">Select Team</label>
                            <select class="form-control" id="team" name="teamId">
                                <option value="">Select Team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->teamId }}" @if($team->teamId == $ticket->ticketAssignTeamId) selected @endif>{{ $team->teamName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $( document ).ready(function() {

            if(teamid == null)
            {
                $('#assignTypeTeam').hide();
            }
            if(assignedEmployeeId == null)
            {
                $('#assignTypeSingle').hide();
            }

        });

        function openModal(x) {
            // var id= $(x).data('panel-id');
            // var workedHour= $(x).data('workedhour');
            // var status= $(x).data('status');
            // var teamid= $(x).data('teamid');
            // var assignedEmployeeId = $(x).data('assign-personid');

            console.log(status);

            if(teamid == null)
            {
                $('#assignTypeTeam').hide();
            }
            if(assignedEmployeeId == null)
            {
                $('#assignTypeSingle').hide();
            }

            $('#modalTicketId').attr('value', id);
            $('#modalWorkedHour').val(workedHour);
            $("#ticketStatus").val(status);
            $("#team").val(teamid);
            $("#assignPerson").val(assignedEmployeeId);

            $('#exampleModal').modal();
        }

        function changeType(x){
            if($(x).val() == 'single'){
                $('#assignTypeTeam').hide();
                $('#assignTypeSingle').show();
            }
            if($(x).val() == 'team'){
                $('#assignTypeSingle').hide();
                $('#assignTypeTeam').show();
            }
        }

        function setRequiredOnClose(x){
            if($(x).val() == 'Close'){
                $("#modalWorkedHour").prop('required',true);
            }
            else{
                $("#modalWorkedHour").prop('required',false);
            }
        }

    </script>


@endsection
