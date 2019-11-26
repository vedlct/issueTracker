<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        
        <div class="card">
            <div class="card-header bg-dark text-white custom-2">
                <h4 class="float-left font-weight-normal">Update Employee Information</h4>
            </div>

            <div class="card-body">
                <div class="">
                    <form method="post" action="<?php echo e(route('employee.update')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($employee->userId); ?>" name="userId">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" name="fullname" value="<?php echo e($employee->fullName); ?>" class="form-control" required placeholder="Fullname">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password1" class="form-control" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password2" class="form-control" placeholder="Confirm Password">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="tel" value="<?php echo e($employee->userPhoneNumber); ?>" name="phone" class="form-control" placeholder="Phone">
                                </div>

                                <div class="form-group">
                                    <label for="company">Select Department</label>
                                    <select class="form-control" id="" name="dept">
                                        <option value="">Select Department</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($department->dept_id); ?>" <?php if($department->dept_id == $employee->department): ?> selected <?php endif; ?>><?php echo e($department->dept_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" value="<?php echo e($employee->email); ?>" name="email" class="form-control" required placeholder="example@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label for="company">Select Company</label>
                                    <select class="form-control" id="company" name="companyId" required>
                                        <option value="">Select Company</option>
                                        <?php $__currentLoopData = $companyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($company->companyId); ?>"  <?php if($company->companyId == $employee->fk_companyId): ?> selected <?php endif; ?>><?php echo e($company->companyName); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Employee Status</label>
                                    <select class="form-control" name="employeeStatus" required>
                                        <option value="">Select Status</option>
                                        <option value="1"  <?php if($employee->status == 1): ?> selected <?php endif; ?>> Active </option>
                                        <option value="0"  <?php if($employee->status == 0): ?> selected <?php endif; ?>> Inactive </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="company">Select Designation</label>
                                    <select class="form-control" id="desg" name="designation">
                                        <option value="">Select Designation</option>
                                        <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($designation->designation_id); ?>" <?php if($designation->designation_id == $employee->designation): ?> selected <?php endif; ?>><?php echo e($designation->designation_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file1">Select Profile Photo</label>
                                    <input type="file" name="profilePhoto" class="form-control-file" id="file1">
                                </div>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>