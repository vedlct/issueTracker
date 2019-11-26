<form action="<?php echo e(route('backlog.update.details')); ?>" method="post">
    <?php echo csrf_field(); ?>

    <input type="hidden" name="backlog_id" value="<?php echo e($backlog->backlog_id); ?>">

    <div class="row mb-3">
        <div class="col-6">
            <label>Change Backlog State</label>
            <select class="form-control pull-right" name="backlog_state" required>
                <option value="Planned" <?php if($backlog->backlog_state == 'Backlog'): ?> selected <?php endif; ?>>Planned</option>
                <option value="Ongoing" <?php if($backlog->backlog_state == 'Doing'): ?> selected <?php endif; ?>>Ongoing</option>
                <option value="Code Done" <?php if($backlog->backlog_state == 'Code Done'): ?> selected <?php endif; ?>>Code Done</option>
                <option value="Testing" <?php if($backlog->backlog_state == 'Testing'): ?> selected <?php endif; ?>>Testing</option>
                <option value="Complete" <?php if($backlog->backlog_state == 'Complete'): ?> selected <?php endif; ?>>Complete</option>
            </select>
        </div>
    </div>

    <table class="table table-sm table-bordered">
        <tbody>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Title</th>
                <td><?php echo e($backlog->backlog_title); ?></td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Select Priority</th>
                <td><?php echo e($backlog->backlog_priority); ?></td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Start Date</th>
                <td><?php echo e($backlog->backlog_start_date); ?></td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog End Date</th>
                <td><?php echo e($backlog->backlog_end_date); ?></td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Expected Time</th>
                <td><?php echo e($backlog->backlog_time); ?></td>
            </tr>
            <tr style="line-height: .5;">
                <th scope="row">Backlog Dev Time</th>
                <td><?php echo e($backlog->dev_time); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row mb-2 mt-3">
        <div class="col">
            <label>Backlog Details</label>
            <textarea id="ckContents" rows="3" placeholder="Backlog Details" name="backlogDetails"><?php echo e($backlog->backlog_details); ?></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col" style="margin-bottom: 10px;">
            <button class="btn btn-success pull-right btn-sm">Save Backlog</button>
        </div>
    </div>

</form>



<div id="comment">

</div>



<div class="card mt-4">
    <div class="card-body" style="padding-bottom: 0px;">
        <div class="form-row">
            <div class="form-group col-md-10">
                <input type="text" id="commentData" class="form-control" placeholder="Your Comment...">
            </div>
            <div class="form-group col-md-2">
                <button onclick="post_comment()" class="btn btn-outline-success btn-block">Comment</button>
            </div>
        </div>
    </div>
</div>


<script>

    $(".datepicker").datepicker({
        orientation: "bottom",
        format: 'yyyy/mm/dd'
    });

    $(document).ready(function() {

        // Send request to load data
        $.ajax({
            type: 'POST',
            url: "<?php echo route('backlog.comment.get'); ?>",
            cache: false,
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                'backlog_id': "<?php echo e($backlog->backlog_id); ?>"
            },
            success: function (data) {
                $('#comment').html(data);
            }
        });

    });

    function loadComments(){
        $.ajax({
            type: 'POST',
            url: "<?php echo route('backlog.comment.get'); ?>",
            cache: false,
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                'backlog_id': "<?php echo e($backlog->backlog_id); ?>"
            },
            success: function (data) {
                $('#comment').html(data);
            }
        });
    }

    // Send request to post a comment
    function post_comment(){
        var comment = $("#commentData").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo route('backlog.comment.post'); ?>",
            cache: false,
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                'comment' : comment,
                'backlog_id': "<?php echo e($backlog->backlog_id); ?>",
                'user_id' : "<?php echo e(Auth::user()->userId); ?>",
            },
            success: function (data) {
                $('#commentData').val('');
                // load comment after request
                loadComments();
            }
        });
    }

    var wage = document.getElementById("commentData");
    wage.addEventListener("keydown", function (e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            post_comment();
        }
    });


    
    var textarea = document.getElementById('ckContents');

    CKEDITOR.replace(textarea);

</script>