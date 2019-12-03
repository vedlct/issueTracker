<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
            Create new team
        </button>

        <!-- Team Insert -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="post" action="<?php echo e(route('team.insert')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="teamname">Team Name</label>
                                <input type="text" name="teamName" class="form-control" id="teamname" required placeholder="Enter team name">
                            </div>

                            <div class="form-group">
                                <label for="company">Select Company</label>
                                <select class="form-control" id="company" name="companyId" required>
                                    <option value="">Select Company</option>
                                    <?php $__currentLoopData = $companylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->companyId); ?>"><?php echo e($company->companyName); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Team List</h4>
            </div>

            <div class="card-body">
                <div class="table table-responsive">
                    <table id="employeeTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Company</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $teamlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($team->teamName); ?> </td>
                                <td> <?php echo e($team->companyName); ?> </td>
                                <td> <?php echo e($team->created_at); ?> </td>

                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo e(route('team.edit', ['id'=>$team->teamId])); ?>"> <i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> </a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>