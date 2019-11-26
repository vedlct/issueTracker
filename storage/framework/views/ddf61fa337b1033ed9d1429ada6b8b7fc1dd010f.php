<?php $__env->startSection('css'); ?>
    <style>
        .card{
            box-shadow: 1px 0 20px rgba(0, 0, 0, .09);
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="row ml-3">
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="card m-4" style="width: 16rem;">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo e($project->project_name); ?></h5>

                    <?php $__currentLoopData = $allStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($project->project_status == $status->statusId): ?>
                            <h6 class="card-subtitle mb-2 text-muted">Project Status : <?php echo e($status->statusData); ?></h6>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="mt-4" style="margin-right: 11px;">
                        <a href="<?php echo e(route('project.features', $project->projectId)); ?>" class="card-link">Dashboard</a>
                        <a href="<?php echo e(route('backlog.dashboard', $project->projectId)); ?>" class="card-link">My Backlog</a>
                        
                    </div>

                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>