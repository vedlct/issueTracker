
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

                @if($edit == false)
                    <td class="text-center">
                        <button class="btn btn-sm btn-success" onclick="editFeature({{ $backlog->backlog_id }})"> <i class="fa fa-cogs"></i> </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteFeature({{ $backlog->backlog_id }})"> <i class="fa fa-trash-o"></i> </button>
                    </td>
                @endif
                <td>{{ $backlog->remark }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"> <b>Total Expected Time</b> </td>
            <td> <b>{{ $backlogs->sum('backlog_time') }}</b> </td>
        </tr>
    @endif


