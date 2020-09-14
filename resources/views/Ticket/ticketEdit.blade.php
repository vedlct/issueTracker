<div class="container-fluid">
    {{-- Ticket Basic Information --}}
    <div class="card">
        <div class="card-header bg-dark text-white custom-2">
            <h4 class="float-left font-weight-normal">Edit : {{ $ticket->ticketTopic }}</h4>
        </div>

        <div class="card-body">
            <div class="">
                <form method="post" action="{{ route('ticket.main.update') }}">
                    @csrf
                    <input type="hidden" name="ticketId" id="modalTicketId" value="{{ $ticket->ticketId }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                                <label for="workedHour">Worked Time</label>
                                <input type="text" name="workedHour" id="workedHour" value="{{ $ticket->workedHour }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-3">
                                <label for="workedHour">Hour / Minute</label>
                                <select class="form-control" id="workTimeType" name="workTimeType">
                                    <option value="">Select Type</option>
                                    <option value="Hour" @if($ticket->workedTimeType == 'Hour') selected @endif>Hour</option>
                                    <option value="Minute" @if($ticket->workedTimeType == 'Minute') selected @endif>Minute</option>
                                </select>
                            </div>
                        </div>
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
                        <label>Emails</label>
                        <select class="form-control" id="" name="email">
                            <option selected disabled>Select Email</option>
                            @foreach($froMail as $email)
                            <option value="{{ $email->email }}">{{ $email->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Personal Note</label>
                        <select class="form-control" id="" name="personal_note">
                            <option selected disabled">Select Previous Comment</option>
                            @foreach($ticket_reply as $reply)
                                <option value="{{ $reply->replyData }}">{{ $reply->replyData }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- New Code --}}

                    @if($ticket->ticketAssignTeamId == null && $ticket->ticketAssignPersonUserId == null)

                        {{-- if assign type is null --}}
                        <div class="form-group" id="null_team_or_emp">
                            <label for="company">Assign Type</label>
                            <select class="form-control" id="assignType" name="assignType" onchange="showType(this)">
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
                                    <option value="{{ $employee->userId }}" @if($employee->userId == $ticket->ticketAssignPersonUserId) selected @endif>{{ $employee->fullName }}</option>
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

                    @else

                        {{-- If value is not null --}}
                        <div class="form-group">
                            <label for="company">Assign Type</label>
                            <select class="form-control" id="assignType" name="assignType" onchange="showType(this)">
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
                                    <option value="{{ $employee->userId }}" @if($employee->userId == $ticket->ticketAssignPersonUserId) selected @endif>{{ $employee->fullName }}</option>
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

                    @endif

                    {{-- New Code End --}}

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $( document ).ready(function() {

        @if($ticket->ticketAssignTeamId != "")
        $('#assignTypeSingle').hide();
        $('#assignTypeTeam').show();

        $('#assignType').val("team");

        console.log("ticketAssignTeamId have value");
        @endif

        @if($ticket->ticketAssignPersonUserId != "")
        $('#assignTypeSingle').show();
        $('#assignTypeTeam').hide();

        $('#assignType').val("single");

        console.log("ticketAssignPersonUserId have value");
        @endif


        {{-- If assign value is null --}}
        @if($ticket->ticketAssignTeamId == null && $ticket->ticketAssignPersonUserId == null)
        $('#assignTypeSingle').hide();
        $('#assignTypeTeam').hide();
        @endif

    });



    function showType(x){
        if($(x).val() == 'single'){
            $('#assignTypeSingle').show();
            $('#assignTypeTeam').hide();
        }
        if($(x).val() == 'team'){
            $('#assignTypeTeam').show();
            $('#assignTypeSingle').hide();

        }
    }

    // function changeType(x){
    //     if($(x).val() == 'single'){
    //         $('#typeSingle').show();
    //         $('#typeteam').hide();
    //     }
    //     if($(x).val() == 'team'){
    //         $('#typeSingle').hide();
    //         $('#typeteam').show();
    //     }
    // }

    function setRequiredOnClose(x){
        if($(x).val() == 'Close'){
            $("#workedHour").prop('required',true);
            $('#workTimeType').prop('required',true);
        }
        else{
            $("#workedHour").prop('required',false);
            $('#workTimeType').prop('required',false);
        }
    }

</script>
