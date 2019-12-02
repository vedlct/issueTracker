
    <?php if(count($backlogs) < 1): ?>
        <td colspan="7" style="text-align: center;"><b>NO FEATURE ADDED YET</b></td>
    <?php else: ?>
        <?php $__currentLoopData = $backlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th style="text-align: center" scope="row"><?php echo e(++$key); ?></th>
                <td><?php echo e($backlog->backlog_title); ?></td>
                <td><?php echo e($backlog->backlog_time); ?></td>
                <?php if($backlog->backlog_state == 'Complete'): ?>
                    <td style="background-color: #2fa360"><?php echo e($backlog->backlog_state); ?></td>
                <?php else: ?>
                    <td><?php echo e($backlog->backlog_state); ?></td>
                <?php endif; ?>

                <td><?php echo e($backlog->backlog_start_date); ?></td>
                <td><?php echo e($backlog->backlog_end_date); ?></td>
                <td><?php echo e($backlog->backlog_priority); ?></td>

                <?php if($edit == false): ?>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success" onclick="editFeature(<?php echo e($backlog->backlog_id); ?>)"> <i class="fa fa-cogs"></i> </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteFeature(<?php echo e($backlog->backlog_id); ?>)"> <i class="fa fa-trash-o"></i> </button>
                    </td>
                <?php endif; ?>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="2"> <b>Total Expected Time</b> </td>
            <td> <b><?php echo e($backlogs->sum('backlog_time')); ?></b> </td>
        </tr>
    <?php endif; ?>


