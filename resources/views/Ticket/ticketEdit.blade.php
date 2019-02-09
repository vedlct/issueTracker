
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
                                    <input type="text" name="workedHour" id="workedTimeType" value="{{ $ticket->workedHour }}" class="form-control" placeholder="">
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

                        <div id="typeSingle">
                            <div class="form-group">
                                <label for="company">Assign Type</label>
                                <select class="form-control" id="assignType" name="assignType" onchange="changeType(this)">
                                    <option value="">Select Type</option>
                                    <option value="single" selected>Assign Single Person</option>
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
                        </div>

                        <div id="typeteam">
                            <div class="form-group">
                                <label for="company">Assign Type</label>
                                <select class="form-control" id="assignType" name="assignType" onchange="changeType(this)">
                                    <option value="">Select Type</option>
                                    <option value="single">Assign Single Person</option>
                                    <option value="team" selected>Assign Team</option>
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
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>

        $( document ).ready(function() {

            @if($ticket->ticketAssignTeamId == null)
                $('#typeSingle').show();
                $('#typeteam').hide();
            @endif

            @if($ticket->ticketAssignPersonUserId == null)
                $('#typeteam').show();
                $('#typeSingle').hide();
            @endif

        });

        function changeType(x){
            if($(x).val() == 'single'){
                $('#typeSingle').show();
                $('#typeteam').hide();
            }
            if($(x).val() == 'team'){
                $('#typeSingle').hide();
                $('#typeteam').show();
            }
        }

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



