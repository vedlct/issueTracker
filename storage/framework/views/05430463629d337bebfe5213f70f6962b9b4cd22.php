
<form action="<?php echo e(route('backlog.dashboard.updateData')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" value="<?php echo e($backlog->backlog_id); ?>" name="backlog_id">
    <div class="form-group">
        <label>Feature Title</label>
        <input type="text" value="<?php echo e($backlog->backlog_title); ?>" name="title" class="form-control" placeholder="Enter Feature Title" required>
    </div>

    <div class="form-group">
        <label>Expected Time (in Hour)</label>
        <input type="number" class="form-control" value="<?php echo e($backlog->backlog_time); ?>" name="exp_time" placeholder="Expected Time">
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Change Feature State</label>
        <select class="form-control pull-right" name="backlog_state" id="backlog_state">
            <option value="Planned" <?php if($backlog->backlog_state == 'Planned'): ?> selected <?php endif; ?>>Planned</option>
            <option value="Ongoing" <?php if($backlog->backlog_state == 'Ongoing'): ?> selected <?php endif; ?>>Ongoing</option>
            <option value="Pause" <?php if($backlog->backlog_state == 'Pause'): ?> selected <?php endif; ?>>Pause</option>
            <option value="Code Done" <?php if($backlog->backlog_state == 'Code Done'): ?> selected <?php endif; ?>>Code Done</option>
            <option value="Testing" <?php if($backlog->backlog_state == 'Testing'): ?> selected <?php endif; ?>>Testing</option>
            <option value="Complete" <?php if($backlog->backlog_state == 'Complete'): ?> selected <?php endif; ?>>Complete</option>
        </select>
    </div>

    <div class="form-group" <?php if($backlog->backlog_state != 'Ongoing'): ?> style="display: none;" <?php endif; ?> id="changeState">
        <label>Hour</label>
        <input type="text" autocomplete="off" class="form-control" name="hour" id="backLogHour">
    </div>

    <div class="form-group">
        <label>Feature Start Date</label>
        <input type="text" id="startDate" value="<?php echo e($backlog->backlog_start_date); ?>" autocomplete="off" class="form-control datepicker" placeholder="Start Date" name="startdate">
    </div>
    <div class="form-group">
        <label>Feature End Date</label>
        <input type="text" id="endDate" value="<?php echo e($backlog->backlog_end_date); ?>" autocomplete="off" class="form-control datepicker" placeholder="End Date" name="enddate">
    </div>

    <div class="form-group">
        <label>Remark</label>
        <input type="text" class="form-control" value="<?php echo e($backlog->remark); ?>" placeholder="Remark" name="remark">
    </div>

    <div class="form-group">
        <label>Priority</label>
        <select class="form-control" name="priority">
            <option value="">Select Priority</option>
            <option value="Low" <?php if($backlog->backlog_priority == 'Low'): ?> selected <?php endif; ?>>Low</option>
            <option value="Medium" <?php if($backlog->backlog_priority == 'Medium'): ?> selected <?php endif; ?>>Medium</option>
            <option value="High" <?php if($backlog->backlog_priority == 'High'): ?> selected <?php endif; ?>>High</option>
        </select>
    </div>

    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary pull-right">SAVE CHANGES</button>
</form>

<script>
    $("#backlog_state").change(function() {
        if($("#backlog_state").val() == 'Ongoing') {
            $("#changeState").show();
            $("#backLogHour").prop('disabled', false);
        }else{
            $("#changeState").hide();
            $("#backLogHour").prop('disabled', true);
        }
    });

    $(".datepicker").datepicker({
        orientation: "bottom",
        format: 'yyyy/mm/dd'
    });
</script>
