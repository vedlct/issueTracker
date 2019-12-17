<?php $__env->startSection('css'); ?>
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        @media  only screen and (min-width: 338px) and (max-width: 379px){
            .top{
                margin-top: 20%;
            }

        }
        @media  only screen and (max-width: 337px){
            .top1{
                margin-top: 60%;
            }

        }
    </style>

    <div class="container-fluid">
        <div class="card top top1">
            <div class="card-header">
                <h4 class="float-left">Today Work</h4>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Full name</th>
                        <th>Project</th>
                        <th>Feature</th>
                        <th>Time Allocated</th>
                        <th>Time Declare</th>
                        <th>State</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $employeelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e($employee->fullName); ?> </td>
                            <td> <?php echo e($employee->project_name); ?> </td>
                            <td> <?php echo e($employee->backlog_title); ?> </td>
                            <td> <?php echo e($employee->backlog_time); ?> </td>
                            <td> <?php echo e(number_format((float)$employee->declare_hour, 2, '.', '')); ?> </td>
                            <td>
                                <?php if($employee->backlog_state==='Planned'): ?>
                                    <?php echo e('Assigned'); ?>

                                <?php else: ?>
                                    <?php echo e($employee->backlog_state); ?>

                                <?php endif; ?>
                            </td>
                            <td> <?php echo e($employee->backlog_start_date); ?> </td>
                            <td> <?php echo e($employee->backlog_end_date); ?> </td>
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
    <script>

        $(document).ready(function() {
            $('#employeeTable').DataTable();
        } );

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>