
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            table, th, td {
                border: 2px solid ;
            }
            td{
                wrap-text:true;
                vertical-align: top;
            }
            .bold{
                font-weight: bold;
            }
        </style>
    </head>

    <body>

        <table id="ticketTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Feature ID</th>
                <th>Feature Topic</th>
                <th>Expected Hour</th>
                <th>Current State</th>
                <th>Start Date</th>
                <th>End Date</th>
                {{--<th colspan="3">Details</th>--}}
                <th>Feature Priority</th>
                <th>Dev Time</th>
                <th>Assigned To</th>
            </tr>
            </thead>
            <tbody>
            @foreach($backlogs as $backlog)
                <tr>
                    <td>{{ $backlog->backlog_id }}</td>
                    <td style="wrap-text: true;">{{ $backlog->backlog_title }}</td>
                    <td>{{ $backlog->backlog_time }}</td>
                    <td>{{ $backlog->backlog_state }}</td>
                    <td>{{ $backlog->backlog_start_date }}</td>
                    <td>{{ $backlog->backlog_end_date }}</td>
                    {{--<td colspan="3">{!! $backlog->backlog_details !!}</td>--}}
                    <td>{{ $backlog->backlog_priority }}</td>
                    <td>{{ $backlog->dev_time }}</td>

                    <td>
                        @foreach($backlog_assigned_emp->where('fk_backlog_id', $backlog->backlog_id) as $emp)
                            {{ $emp->fullName }},
                        @endforeach
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>{{$backlog->sum('backlog_time')}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

    </body>
</html>


