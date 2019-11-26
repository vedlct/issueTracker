<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Update Project Information</h4>
        </div>
        <div class="card-body">
            <form method="post">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Project Name</label>
                        <input type="text" class="form-control" placeholder="Project Name" value="<?php echo e($project->projectName); ?>" name="projectname" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Select Company</label>
                        <select class="form-control" name="companyId" required>
                            <?php $__currentLoopData = $companylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($project->fk_companyId == $company->companyId): ?>
                                    <option value="<?php echo e($company->companyId); ?>" selected><?php echo e($company->companyName); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($company->companyId); ?>"><?php echo e($company->companyName); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Project Expected Duration</label>
                        <input type="text" required value="<?php echo e($project->projectDuration); ?>" class="form-control" placeholder="Enter Project Expected Duration" value="" name="duration">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Project Status</label>
                        <select class="form-control" name="status" required>
                            <!-- <option value="1" <?php if( $project->projectStatus == '1' ): ?> selected <?php endif; ?>> Open </option>
                            <option value="2" <?php if( $project->projectStatus == '2' ): ?> selected <?php endif; ?>> Pending </option>
                            <option value="3" <?php if( $project->projectStatus == '3' ): ?> selected <?php endif; ?>> Running </option> -->

                            <?php $__currentLoopData = $allStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($project->projectStatus == $status->statusId): ?>
                                    <option value="<?php echo e($status->statusId); ?>" selected><?php echo e($status->statusData); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($status->statusId); ?>"><?php echo e($status->statusData); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Project Summary</label>
                        <textarea class="form-control" placeholder="Project Summary" name="summary" required><?php echo e($project->projectSummary); ?></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-success">Create Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>