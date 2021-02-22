<div class="container-fluid">
    {{-- Ticket Basic Information --}}
    <div class="card">
        <div class="card-header bg-dark text-white custom-2">
            <h4 class="float-left font-weight-normal">Edit : {{ $ticket->ticketTopic }}</h4>
        </div>
        <div class="card-body">
            <div class="">
                <form method="post" action="{{ route('ticket.info.update') }}">
                    @csrf
                    <input type="hidden" name="ticketId" id="modalTicketId" value="{{ $ticket->ticketId }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Ticket Topic</label>

                                <input type="text" name="ticketTopic" value="{{ $ticket->ticketTopic }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Ticket Priority</label>
                                <select class="form-control" name="ticketPriority">
                                    <option value="">Select Priority</option>
                                    <option value="High" @if($ticket->ticketPriority == 'High') selected @endif>High</option>
                                    <option value="Medium" @if($ticket->ticketPriority == 'Medium') selected @endif>Medium</option>
                                    <option value="Low" @if($ticket->ticketPriority == 'Low') selected @endif>Low</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Ticket Created Date</label>
                                <input type="date" name="created_at" value="{{ date('Y-m-d', strtotime($ticket->created_at)) }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Ticket Created Time</label>
                                <input type="time" name="created_time" value="{{ $ticket->created_time }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Ticket Last Updated</label>

                                <input type="datetime-local" name="lastUpdated" value="{{ date('d-m-Y', strtotime($ticket->lastUpdated)) }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Ticket Close Date</label>
                                <input type="date" name="closed_at" value="{{ $ticket->closed_at }}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Work Hour</label>
                                <input type="number" name="workedHour" value="{{$ticket->workedHour}}" class="form-control" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label>Ticket Status</label>
                                <select class="form-control" name="ticketStatus">
                                    <option value="">Select Status</option>
                                    <option value="Open" @if($ticket->ticketStatus == 'Open') selected @endif>Open</option>
                                    <option value="Close" @if($ticket->ticketStatus == 'Close') selected @endif>Close</option>
                                    <option value="Pending" @if($ticket->ticketStatus == 'Pending') selected @endif>Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--assign section--}}
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

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


    function showType(x) {
        if ($(x).val() == 'single') {
            $('#assignTypeSingle').show();
            $('#assignTypeTeam').hide();
        }
        if ($(x).val() == 'team') {
            $('#assignTypeTeam').show();
            $('#assignTypeSingle').hide();

        }
    }
</script>
