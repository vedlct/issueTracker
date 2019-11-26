<?php $__env->startSection('css'); ?>
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">Admin List</h4>
            </div>
            <div class="card-body">
                <table id="adminTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Type</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $adminlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e($admin->fullName); ?> </td>
                            <td> <?php echo e($admin->email); ?> </td>
                            <td> <?php echo e($admin->userPhoneNumber); ?> </td>
                            <td> <?php echo e($admin->userType); ?> </td>

                            <td> <?php echo e($admin->companyName); ?> </td>
                            <td>
                                <?php if($admin->status == 1): ?>
                                    Active
                                <?php else: ?>
                                    Inactive
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="location.href='<?php echo e(route('user.edit.admin', ['emp_id'=>$admin->userId])); ?>'"> <i class="fa fa-pencil-square" aria-hidden="true"></i> </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteAdmin(<?php echo e($admin->userId); ?>)"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

        $(document).ready(function() {
            $('#adminTable').DataTable();
        } );

        function deleteAdmin(x) {
            id = x;
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        // DELETE
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo e(route('user.delete.admin')); ?>",
                            cache: false,
                            data: {
                                _token: "<?php echo e(csrf_token()); ?>",
                                'id': id
                            },
                            success: function (data) {
                                location.reload(true);
                                // $.alert({
                                //     animationBounce: 2,
                                //     title: 'Success!',
                                //     content: 'Admin Deleted',
                                // });
                            }
                        });
                    },
                    cancel: function () {

                    },
                }
            });

        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>