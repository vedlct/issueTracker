<?php $__env->startSection('css'); ?>
    
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">Client List</h4>
                <a href="<?php echo e(route('add.client')); ?>" class="btn btn-success float-right" name="button">Add Client</a>
            </div>
            <div class="card-body">
                <table id="employeeTable" class="table-bordered table-condensed text-center table-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Type</th>
                        <th>Client Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $clientlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e($client->fullName); ?> </td>
                            <td> <?php echo e($client->email); ?> </td>
                            <td> <?php echo e($client->userPhoneNumber); ?> </td>
                            <td> <?php echo e($client->userType); ?> </td>
                            <td>
                                <?php if($client->status == 1): ?>
                                    Active
                                <?php else: ?>
                                    Inactive
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="location.href='<?php echo e(route('edit.client.profile', ['client_id'=>$client->userId])); ?>'"> <i class="fa fa-cog" aria-hidden="true"></i> </button>
                                
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
            $('#employeeTable').DataTable();
        } );

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainLayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>