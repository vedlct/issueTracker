
<form action="{{ route('backlog.dashboard.updateData') }}" method="post">
    @csrf
    <input type="hidden" value="{{ $backlog->backlog_id }}" name="backlog_id">
    <div class="form-group">
        <label>Feature Title</label>
        <input type="text" value="{{ $backlog->backlog_title }}" name="title" class="form-control" placeholder="Enter Feature Title" required>
    </div>

    <div class="form-group">
        <label>Expected Time (in Hour)</label>
        <input type="number" class="form-control" value="{{ $backlog->backlog_time }}" name="exp_time" placeholder="Expected Time">
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Change Feature State</label>
        <select class="form-control pull-right" name="backlog_state">
            <option value="Planned" @if($backlog->backlog_state == 'Planned') selected @endif>Planned</option>
            <option value="Ongoing" @if($backlog->backlog_state == 'Ongoing') selected @endif>Ongoing</option>
            <option value="Pause" @if($backlog->backlog_state == 'Pause') selected @endif>Pause</option>
            <option value="Code Done" @if($backlog->backlog_state == 'Code Done') selected @endif>Code Done</option>
            <option value="Testing" @if($backlog->backlog_state == 'Testing') selected @endif>Testing</option>
            <option value="Complete" @if($backlog->backlog_state == 'Complete') selected @endif>Complete</option>
        </select>
    </div>

    <div class="form-group">
        <label>Feature Start Date</label>
        <input type="text" id="startDate" value="{{ $backlog->backlog_start_date }}" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="startdate">
    </div>
    <div class="form-group">
        <label>Feature End Date</label>
        <input type="text" id="endDate" value="{{ $backlog->backlog_end_date }}" autocomplete="off" class="form-control datepicker" placeholder="End Date" name="enddate">
    </div>

    <div class="form-group">
        <label>Remark</label>
        <input type="text" class="form-control" value="{{ $backlog->remark }}" placeholder="Remark" name="remark">
    </div>

    <div class="form-group">
        <label>Priority</label>
        <select class="form-control" name="priority">
            <option value="">Select Priority</option>
            <option value="Low" @if($backlog->backlog_priority == 'Low') selected @endif>Low</option>
            <option value="Medium" @if($backlog->backlog_priority == 'Medium') selected @endif>Medium</option>
            <option value="High" @if($backlog->backlog_priority == 'High') selected @endif>High</option>
        </select>
    </div>

    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary pull-right">SAVE CHANGES</button>
</form>

<script>
    $(".datepicker").datepicker({
        orientation: "bottom",
        format: 'yyyy/mm/dd'
    });
</script>
