<table id="ticketTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
    <thead>
    <tr>
        <th>Ticket No.</th>
        <th>Ticket Topic</th>
        <th>Ticket Status</th>
        <th>Project</th>
        <th>Ticket Created at</th>
        <th>Ticket Closed at</th>
        <th>Ticket Priority</th>
        <th>Worked Time</th>
        <th>Worked Time Type</th>
        <th>Ticket Opener</th>

        <th>Assigned To</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allTicket as $ticket)
        <tr>
            <td>{{ $ticket->ticket_number }}</td>
            <td>{{ $ticket->ticketTopic }}</td>
            <td>{{ $ticket->ticketStatus }}</td>
            <td>{{ $ticket->project_name }}</td>
            <td>{{ $ticket->created_at }}</td>
            <td>{{ $ticket->closed_at }}</td>
            <td>{{ $ticket->ticketPriority }}</td>
            <td>{{ $ticket->workedHour }}</td>
            <td>{{ $ticket->workedTimeType }}</td>
            <td>{{ $ticket->createdFullName }}</td>

            <td colspan="2">
            @if($ticket->assignTeamMembers != null)
              {{ $ticket->assignTeamMembers }}
            @else
                {{$ticket->assignFullName}}
            @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
