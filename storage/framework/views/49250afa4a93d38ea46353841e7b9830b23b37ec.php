<?php $__env->startSection('css'); ?>
    
        
            
        
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">Employee List</h4>
                <a href="<?php echo e(route('user.add.employee')); ?>" class="btn btn-success float-right" name="button">Add Employee</a>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                            <th>User Designation</th>
                            <th>Employee Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $employeelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($employee->fullName); ?> </td>
                                <td> <?php echo e($employee->email); ?> </td>
                                <td> <?php echo e($employee->userPhoneNumber); ?> </td>
                                <td> <?php echo e($employee->userType); ?> </td>
                                <td> <?php echo e($employee->designation_name); ?> </td>
                                <td>
                                    <?php if($employee->status == 1): ?>
                                        Active
                                    <?php else: ?>
                                        Inactive
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="location.href='<?php echo e(route('edit.employee.profile', ['emp_id'=>$employee->userId])); ?>'"> <i class="fa fa-pencil-square" aria-hidden="true"></i> </button>
                                    
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
    <script>

        $(document).ready(function() {
            $('#employeeTable').DataTable();
        } );

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>