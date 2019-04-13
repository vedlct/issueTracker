

    @if(count($backlogs) < 1)
        <td colspan="7" style="text-align: center;"><b>NO FEATURE ADDED YET</b></td>
    @else
        @foreach($backlogs as $key => $backlog)
            <tr>
                <th style="text-align: center" scope="row">{{ ++$key }}</th>
                <td>{{ $backlog->backlog_title }}</td>
                <td>{{ $backlog->backlog_time }}</td>
                @if($backlog->backlog_state == 'Complete')
                    <td style="background-color: #2fa360">{{ $backlog->backlog_state }}</td>
                @else
                    <td>{{ $backlog->backlog_state }}</td>
                @endif

                <td>{{ $backlog->backlog_start_date }}</td>
                <td>{{ $backlog->backlog_end_date }}</td>
                <td>{{ $backlog->backlog_priority }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"> <b>Total Expected Time</b> </td>
            <td colspan="5"> <b>{{ $backlogs->sum('backlog_time') }}</b> </td>
        </tr>
    @endif


