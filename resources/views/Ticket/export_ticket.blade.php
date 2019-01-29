<table id="ticketTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
    <thead>
    <tr>
        <th>Ticket Topic</th>
        <th>Ticket Status</th>
        <th>Project</th>
        <th>Ticket Created at</th>
        <th>Ticket End at</th>
        <th>Ticket Priority</th>
        <th>Worked Hour</th>
        <th>Ticket Opener</th>

        <th>Assigned To</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allTicket as $ticket)
        <tr>
            <td>{{ $ticket->ticketTopic }}</td>
            <td>{{ $ticket->ticketStatus }}</td>
            <td>{{ $ticket->projectName }}</td>
            <td>{{ $ticket->created_at }}</td>
            <td>{{ $ticket->end_at }}</td>
            <td>{{ $ticket->ticketPriority }}</td>
            <td>{{ $ticket->workedHour }}</td>

            <td>{{ $ticket->fk_ticketOpenerId }}</td>
            <td>{{ $ticket->ticketAssignPersonUserId }}</td>

        </tr>
    @endforeach
    </tbody>
</table>