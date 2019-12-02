<div class="row">

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-primary text-light text-center">Planned</li>
            <?php $__currentLoopData = $backlogs->where('backlog_state', "Planned"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item changeMouse" data-backlog-id= <?php echo e($backlog->backlog_id); ?> onclick="openItem(this)">
                    <span> <b> <?php echo e($backlog->backlog_title); ?> </b>  </span>

                    <?php $__currentLoopData = $backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->userId == $emp->userId): ?>
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item bg-secondary text-light text-center">Ongoing</li>
            <?php $__currentLoopData = $backlogs->where('backlog_state', "Ongoing"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item changeMouse" data-backlog-id= <?php echo e($backlog->backlog_id); ?> onclick="openItem(this)">
                    <span> <b> <?php echo e($backlog->backlog_title); ?> </b>  </span>

                    <?php $__currentLoopData = $backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->userId == $emp->userId): ?>
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item bg-warning text-light text-center">Code Done</li>
            <?php $__currentLoopData = $backlogs->where('backlog_state', "Code Done"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item changeMouse" data-backlog-id= <?php echo e($backlog->backlog_id); ?> onclick="openItem(this)">
                    <span> <b> <?php echo e($backlog->backlog_title); ?> </b>  </span>

                    <?php $__currentLoopData = $backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->userId == $emp->userId): ?>
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item bg-danger text-light text-center">Testing</li>
            <?php $__currentLoopData = $backlogs->where('backlog_state', "Testing"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item changeMouse" data-backlog-id= <?php echo e($backlog->backlog_id); ?> onclick="openItem(this)">
                    <span> <b> <?php echo e($backlog->backlog_title); ?> </b>  </span>

                    <?php $__currentLoopData = $backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->userId == $emp->userId): ?>
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item bg-success text-light text-center">Complete</li>
            <?php $__currentLoopData = $backlogs->where('backlog_state', "Complete"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item changeMouse" data-backlog-id= <?php echo e($backlog->backlog_id); ?> onclick="openItem(this)">
                    <span> <b> <?php echo e($backlog->backlog_title); ?> </b>  </span>

                    <?php $__currentLoopData = $backlogassignedEmp->where('fk_backlog_id', $backlog->backlog_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(Auth::user()->userId == $emp->userId): ?>
                            <span class="badge badge-dark pull-right">My Backlog</span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

</div>


<!-- Item Details Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="backlog_details">



            </div>
        </div>
    </div>
</div>



<?php $__env->startSection('extra_js'); ?>


<?php $__env->stopSection(); ?>